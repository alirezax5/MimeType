<?php
namespace alirezax5;

class MimeType
{
//region property MimeType
    const  AllMimeType = [
        'empty' => 'application/x-empty',
        '123' => 'application/vnd.lotus-1-2-3',
        '3dml' => 'text/vnd.in3d.3dml',
        'aab' => 'application/x-authorware-bin',
        'aam' => 'application/x-authorware-map',
        'aas' => 'application/x-authorware-seg',
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'x3d' => 'application/vnd.hzn-3d-crossword',
        'mseq' => 'application/vnd.mseq',
        'pwn' => 'application/vnd.3m.post-it-notes',
        'plb' => 'application/vnd.3gpp.pic-bw-large',
        'psb' => 'application/vnd.3gpp.pic-bw-small',
        'pvb' => 'application/vnd.3gpp.pic-bw-var',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',
        '7z' => 'application/x-7z-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',
        '3g2' => 'video/3gpp2',
        '3gp' => 'video/3gpp',
        'aac' => 'audio/x-aac',
        'flv' => 'video/x-flv',
        'mp4' => 'video/mp4',
        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',
        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'docx' => 'application/msword',
        'xlsx' => 'application/vnd.ms-excel',
        'pptx' => 'application/vnd.ms-powerpoint',
        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    ];
    private static $allowMime = [];
    private static $allowxtension = [];

//endregion property
//region Array tools

    public function array_values_exists($value, $array)
    {
        foreach ($array as $key => $val) {
            if ($value == $val) {
                return $key;
            }
        }
        return false;
    }

//endregion Array tools
//region function setter
    public static function setAllowMime(...$mime): MimeType
    {
        foreach ($mime as $item) {
            if (!in_array($item, self::$allowMime) and self::array_values_exists($item, self::AllMimeType)) {
                self::$allowMime[] = $item;
            }
        }

        return new static();
    }

    public static function setAllowExtension(...$Extension): MimeType
    {
        foreach ($Extension as $item) {
            if (!in_array($item, self::$allowxtension) and array_key_exists($item, self::AllMimeType)) {
                self::$allowxtension[] = $item;
            }
        }

        return new static();
    }

//endregion function setter
//region geter function
    public static function getAllowMime(): array
    {
        return self::$allowMime;
    }

    public static function getAllowExtension(): array
    {
        return self::$allowxtension;
    }

    public static function getAllMime(): array
    {
        return self::AllMimeType;
    }

    public static function getMimeFromExtension(string $extension)
    {

        if (array_key_exists($extension, self::AllMimeType)) {
            return self::AllMimeType[$extension];
        }
        return false;
    }

    public static function getExtensionFromMimeType(string $Mime)
    {

        return self::array_values_exists($Mime, self::AllMimeType);
    }

    public static function getMimeFromFileName($name)
    {
        $path = pathinfo($name)['extension'];
        if (array_key_exists($path, self::AllMimeType)) {
            return self::AllMimeType[$path];
        }
        return false;
    }

    public static function getExtensionFromFileName($name)
    {
        return pathinfo($name)['extension'] ?? '';
    }

    public static function getExtensionFromContent($path)
    {
        if (self::getMimeromContent($path)) {
            return self::getExtensionFromMimeType(self::getMimeromContent($path));
        }
        return false;
    }

    public static function getMimeFromContent($path)
    {
        if (is_file($path)) {
            return mime_content_type($path);
        }
        return false;
    }
//endregion geter function
//region  functionvalid
    public static function isAllowed(string $filename)
    {
        if (self::isAllowExtension($filename) || self::isAllowMime($filename)) {
            return true;
        }
        return false;
    }

    public static function isAllowMime(string $filename): bool
    {
        $ex = self::getExtensionFromFileName($filename);
        if ($ex) {
            return in_array(self::getMimeFromExtension($ex), self::$allowMime);
        }
        return false;
    }

    public static function isAllowExtension(string $filename)
    {
        $ex = self::getExtensionFromFileName($filename);
        if ($ex) {
            return in_array($ex, self::$allowxtension);
        }
        return false;
    }
    //endregion function valid

}
