<?php

namespace yii2fullcalendar;

use yii\web\AssetBundle;

/**
 * @link http://www.frenzel.net/
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

class CoreAsset extends AssetBundle
{
    /**
     * tell the calendar, if you like to render google calendar events within the view
     * @var boolean
     */
    public $googleCalendar = false;

    /**
     * [$js description]
     * @var array
     */
    public $js = [
        // Fullcalendar doesn't distribute prebuilt js anymore, will eventually require
        // embedding assets in the extension
        // https://github.com/fullcalendar/fullcalendar/issues/4566
        'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js',
        'https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/locales-all.global.min.js',
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        // Serve unminified files when YII_DEBUG
        if (YII_DEBUG) {
            foreach ($this->js as $jsk => $jsfile) {
                $this->js[$jsk] = str_replace(".min", "", $jsfile);
            }
        }
        parent::registerAssetFiles($view);
    }
}
