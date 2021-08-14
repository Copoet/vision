<?php

namespace App\Services\Common;

class ImageService
{


    /**
     *
     * @param $imgUrl
     * @param $appKey
     * @return array
     */
    public function getImageInfo($imgUrl, $appKey)
    {
        $exif = exif_read_data($imgUrl, 0, true);

        if (isset($exif['GPS'])) {
            $latitude        = $exif['GPS']['GPSLatitude'];   //纬度
            $longitude       = $exif['GPS']['GPSLongitude']; //经度
            $GPSLatitudeRef  = $exif['GPS']['GPSLatitudeRef']; //南半球 S 北半球 N
            $GPSLongitudeRef = $exif['GPS']['GPSLongitudeRef']; //东半球 S 西半球 N
            //计算经纬度信息
            $latitude    = self::getGpsInfo($latitude, $GPSLatitudeRef);
            $longitude   = self::getGpsInfo($longitude, $GPSLongitudeRef);
            $addressInfo = self::getMapAddress($appKey, $longitude, $latitude);
        }

        //图片拍摄时间
        $time = $exif['EXIF']['DateTimeOriginal'];
        //拍摄器材
        $makeModel = $exif['IFD0']['Model'];
        //图片宽高
        $imgSize = getimagesize($imgUrl);
        $width   = $imgSize[0];
        $height  = $imgSize[1];
        $data    = array(
            'makeModel'  => $makeModel,
            'imgTime'    => $time,//图片拍摄时间
            'latitude'   => $latitude ?? '',//纬度
            'longitude'  => $longitude ?? '',//经度
            'address'    => $addressInfo['address'] ?? '',//详细地址
            'province'   => $addressInfo['province'] ?? '',//省份
            'city'       => $addressInfo['city'] ?? '',//城市
            'district'   => $addressInfo['district'] ?? '',//区
            'township'   => $addressInfo['township'] ?? '',//街道
            'scenicSpot' => $addressInfo['scenicSpot'] ?? '',//景点名称
            'height'     => $height,
            'width'      => $width
        );

        return $data;
    }

    /**
     * 获取高德地址信息
     * @param $appKey
     * @param $longitude
     * @param $latitude
     */
    public function getMapAddress($appKey, $longitude, $latitude)
    {
        /**使用高德地图提供逆向地理编码接口获取定位信息;
         * 需在高德申请key
         * 高德接口地址:http://lbs.amap.com/api/webservice/guide/api/georegeo
         */
        $url         = "http://restapi.amap.com/v3/geocode/regeo?key=$appKey&location=$longitude,$latitude&poitype=&radius=10000&extensions=all&batch=false&roadlevel=0";
        $addressInfo = file_get_contents($url);
        $addressInfo = json_decode($addressInfo, true);

        $result = [];
        if ($addressInfo['status'] == 1) {
            $result['address']  = $addressInfo['regeocode']['formatted_address'];
            $result['province'] = $addressInfo['regeocode']['addressComponent']['province'];
            $result['district'] = $addressInfo['regeocode']['addressComponent']['district'];
            $result['township'] = $addressInfo['regeocode']['addressComponent']['township'];
            $result['city']     = $addressInfo['regeocode']['addressComponent']['city'];
        }

        return $result;
    }

    /**
     *  获取gps信息
     * @param $exifCord
     * @param $banqiu
     * @return false|float|int
     */
    public function getGpsInfo($exifCord, $banqiu)
    {
        $degrees = count($exifCord) > 0 ? self::gps2Num($exifCord[0]) : 0;
        $minutes = count($exifCord) > 1 ? self::gps2Num($exifCord[1]) : 0;
        $seconds = count($exifCord) > 2 ? self::gps2Num($exifCord[2]) : 0;
        $minutes += 60 * ($degrees - floor($degrees));
        $degrees = floor($degrees);
        $seconds += 60 * ($minutes - floor($minutes));
        $minutes = floor($minutes);
        if ($seconds >= 60) {
            $minutes += floor($seconds / 60.0);
            $seconds -= 60 * floor($seconds / 60.0);
        }
        if ($minutes >= 60) {
            $degrees += floor($minutes / 60.0);
            $minutes -= 60 * floor($minutes / 60.0);
        }
        $lng_lat = $degrees + $minutes / 60 + $seconds / 60 / 60;
        if (strtoupper($banqiu) == 'W' || strtoupper($banqiu) == 'S') {
            //如果是南半球 或者 西半球 乘以-1
            $lng_lat = $lng_lat * -1;
        }

        return $lng_lat;
    }

    /**
     * 分数 转 小数
     * @param $cordPart
     * @return float|int|mixed|string
     */
    public function gps2Num($cordPart)
    {
        $parts = explode('/', $cordPart);
        if (count($parts) <= 0)
            return 0;
        if (count($parts) == 1)
            return $parts[0];

        return floatval($parts[0]) / floatval($parts[1]);
    }

}
