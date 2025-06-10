<?php
namespace App\Lib;

class MyUtil
{
    // 全角英数 -> 半角英数
    // 全角スペース -> 半角スペース
    // 全角ハイフン -> 半角ハイフン
    // 前後のトリム
    public static function toStoreText($text): string
    {
        return trim(str_replace('－', '-' ,mb_convert_kana($text,'rKVas','UTF-8')));
    }

    public static function arrayDuplicateItemKeys($list): array
    {
        $dupList = array_keys(array_filter(array_count_values($list), function($v){
            return --$v;
        }));
        if(!$dupList) return [];
        return array_keys(array_filter($list,function($v)use($dupList){
            return in_array($v,$dupList);
        }));
    }
}