# yii2fullcalendar

Fullcalendar extension for Yii2 * https://github.com/fullcalendar/fullcalendar

Uses Fullcalendar v6 assets **from CDN**.
License MIT

This is a small update using v6 calendar. It's stil a *draft*, as not all features have been implemented, but it's working.
Feel free to open PRs for improvements.

Originally developed by philipp@frenzel.net.

## Installation

Package is although registered at packagist.org - so you can just add one line of code, to let it run!

add the following line to your composer.json require section:
```json
  "yetopen/yii2fullcalendar":"*",
```

or run:
```
$ php composer.phar require yetopen/yii2fullcalendar "*"
```

## Changelog

2023.04.19 Updated to use v6 library
2019.04.17 Updated to latest 4.0.2 Stable Version of the library
2017.01.19 Updated to include non-standard fields
2014.11.29 Updated to latest 2.2.3 Version of the library

## Usage

Quickstart Looks like this:

```php

  $events = array();
  //Testing
  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 1;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\TH:i:s\Z');
  $Event->nonstandard = [
    'field1' => 'Something I want to be included in object #1',
    'field2' => 'Something I want to be included in object #2',
  ];
  $events[] = $Event;

  $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 2;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
  $events[] = $Event;

  ?>

  <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
  ));
```

Note, that this will only view the events without any detailed view or option to add a new event.. etc.

## Non-Standard fields

You can add non-standard fields via the non-standard fields array, for which you can pass any key/value pair, as described in the [Event Fields](https://fullcalendar.io/docs/event_data/Event_Object/) documentation.

So, using the Quick Start example above, you can read `field1` and `fields2` in your JavaScript using notation similar to `event.nonstandard.field1` and `event.nonstandard.field2`.

## AJAX Usage

If you wanna use ajax loader, this could look like this:

# 20171023 ajaxEvents are replaced by events - pls. check fullcalendar io documentation for details

```php
<?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        'lang' => 'de',
        //... more options to be defined here!
      ],
      'events' => Url::to(['/timetrack/default/jsoncalendar'])
    ]);
?>
```

and inside your referenced controller, the action should look like this:

```php
public function actionJsoncalendar($start=NULL,$end=NULL,$_=NULL){

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $times = \app\modules\timetrack\models\Timetable::find()->where(array('category'=>\app\modules\timetrack\models\Timetable::CAT_TIMETRACK))->all();

    $events = array();

    foreach ($times AS $time){
      //Testing
      $Event = new \yii2fullcalendar\models\Event();
      $Event->id = $time->id;
      $Event->title = $time->categoryAsString;
      $Event->start = date('Y-m-d\TH:i:s\Z',strtotime($time->date_start.' '.$time->time_start));
      $Event->end = date('Y-m-d\TH:i:s\Z',strtotime($time->date_end.' '.$time->time_end));
      $events[] = $Event;
    }

    return $events;
  }
```
