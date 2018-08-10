<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Tasks;

/**
 * Robot example task
 *
 * Ruthlessly stolen from the beareded Canadian sexy symbol:
 *
 *      Derek Allard: http://derekallard.com/
 *
 * @package     Fuel
 * @version     1.0
 * @author      Phil Sturgeon
 */

class Event
{

    public static function sendRemind() {
        $count = \Model_Event::getRemindEvents()->count();
        $oil_path = \util_uri::getOilPath();
        $limit = 10;
        $offset = 0;

        \Log::error('start update check profile');
        while ($count > 0) {
          exec('FUEL_ENV='.\Fuel::$env.' php '.$oil_path.'oil r Event:_sendRemindToUsers '.$offset.' '.$limit);
          $count -= $limit;
          $offset += $limit;
        }
        \Log::error('end update check profile');

    }

    public static function _sendRemindToUsers ($offset, $limit) {
        $events = \Model_Event::getRemindEvents()->rows_offset($offset)->rows_limit($limit)->get();
        foreach ($events as $key => $event) {
            $reserved_requests = $event->reserved_requests;
            foreach ($reserved_requests as $key => $reserved_request) {
                if ($event->approval == 0)
                {
                    \Sendmail::remindEvent($reserved_request->id);
                }
                else if ($event->approval == 1)
                {
                    if ($reserved_request->approval == \Model_Event_Request::APPROVAL)
                    {
                        \Sendmail::remindEvent($reserved_request->id);
                    }
                }
            }
        }
    }

    public static function sendRemindTest(){
    	$requestId = 868;
		\Sendmail::remindEvent($requestId);
	}

}


