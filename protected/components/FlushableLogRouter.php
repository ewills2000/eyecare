<?php


class FlushableLogRouter extends CLogRouter

{
    public
 
$autoFlush = 20;

    public
 
function
 
init()
    {
        parent::init();

        $logger = Yii::getLogger();
        $logger->autoFlush = $this->autoFlush;
        $logger->detachEventHandler('onFlush', array($this, 'collectLogs'));
        $logger->attachEventHandler('onFlush', array($this, 'processLogs'));
    }

    public
 
function processLogs($logs)
    {
        parent::processLogs($logs);
        foreach (parent::getRoutes() as $route) {
            $route->logs = array();
        }
    }
}