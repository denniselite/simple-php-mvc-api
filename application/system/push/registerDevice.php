<?php

require_once('config.php');
require_once('classes/DataService.php');

if (!isset($_REQUEST['deviceToken']) || $_REQUEST['deviceToken'] == '') {

    echo $_REQUEST['deviceToken'];
    exit("No deviceToken set");
}

if (!isset($_REQUEST['appId']) || $_REQUEST['appId'] == '') {
    echo $_REQUEST['appId'];
    exit('Not appId set');
}


echo "<br/>Registering Device (if it does not exist already)";
DataService::singleton()->RegisterDevice($_REQUEST['deviceToken']);

echo "<br/>Enabling Device for App: [{$_REQUEST['appId']}] (if not enabled already)";
DataService::singleton()->setDeviceActive($_REQUEST['deviceToken'], $_REQUEST['appId'], 1);

//optional
if(isset($_REQUEST['appSubscriptionId']))
{
	echo "<br/>Registering for Subscription". $_REQUEST['appSubscriptionId'];
	DataService::singleton()->updateAppSubscription($_REQUEST['deviceToken'], $_REQUEST['appSubscriptionId'], 1);
}

if(isset($_REQUEST['feedUrl'])){
	echo "\n<br/>Register Feed: {$_REQUEST['feedUrl']} ";
	$feedId = DataService::singleton()->registerFeed($_REQUEST['feedUrl']);
	echo "\n<br/>FeedId: {$feedId}";
	DataService::singleton()->subscribeDeviceToFeed($_REQUEST['deviceToken'], $_REQUEST['appId'], $feedId, $_REQUEST['feedEnable']);
}