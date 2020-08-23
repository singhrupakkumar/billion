<?php



namespace App;

use URL;

use Carbon\Carbon;

use DateTime;

use DateInterval;



class Helper

{

    public static function userimg($data)

    {

        if($data){

            return  $data;

        }else{

          return  URL::to("/").'/images/users/no_img.png';

        }

      

    }



    public static function catImg($data)

    {

        if($data){

            return  $data;

        }else{

          return  URL::to("/").'/images/categories/noImageFound.jpg';

        }

      

    }

     public static function winnerImg($data)

    {

        if($data){

            return  $data;

        }else{

          return  URL::to("/").'/images/prize_image/winner.png';

        }

      

    }

    public static function encodeNum($num)

    {

       return base64_encode($num);

    }



    public static function decodeNum($num) 

    {

       return base64_decode($num); 

    }





    public static function timeslots($start,$end,$timeslot){



            $timeArray = [];

            $finish = strtotime(date($end));

            $k =0 ;

            for($i=1; $i<=96;$i++){

                $k+=$timeslot;

                $selectedTime = date($start);

                $endTime = strtotime("+".$k." minutes", strtotime($selectedTime));

                if($finish<$endTime){

                    break;

                }

                $timeArray[] = date('h:i a', $endTime); 

            }



            return $timeArray;

       

    }





    public static function timeslotsBetween($duration, $cleanup, $start, $end, $break_start, $break_end) {

        $start         = new DateTime($start);

        $end           = new DateTime($end);

        $break_start           = new DateTime($break_start);

        $break_end           = new DateTime($break_end);

        $interval      = new DateInterval("PT" . $duration . "M");

        $cleanupInterval = new DateInterval("PT" . $cleanup . "M");

        $periods = array();

    

        $counter = 0;

        for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {

            $endPeriod = clone $intStart;

            $endPeriod->add($interval);

    

            if(strtotime($break_start->format('H:i A')) < strtotime($endPeriod->format('H:i A')) && strtotime($endPeriod->format('H:i A')) < strtotime($break_end->format('H:i A'))){

                $endPeriod = $break_start; 

                $periods[$counter]['from'] = $intStart->format('H:i A');

                $periods[$counter]['to'] =  $endPeriod->format('H:i A');

                $intStart = $break_end;

                $endPeriod = $break_end;

                $intStart->sub($interval);

            }else{

                $periods[$counter]['from'] = $intStart->format('H:i A');

                $periods[$counter]['to'] =  $endPeriod->format('H:i A');

            }



            $counter++;

        }

    

    

        return $periods;

    }



    public static function dateSlot(){

            $start = date("Y-m-d");

            $lastDayThisMonth = date("Y-m-t");

            $nextThirty =  date('Y-m-d', strtotime($start . ' +30 day'));

           $dateArray = [];

           //$finish = strtotime(date($lastDayThisMonth));

           $finish = strtotime(date($nextThirty));

           $k =0 ;

           $counter = 0;

           for($i=1; $i<=96;$i++){

               //$k+=1;

                    if (date('H') < 22 && date('H') > 9) {  



                   }else{   

                     $k+=1; 

                   }

               $selectedTime = date($start);

               $endTime = strtotime("+".$k." days", strtotime($selectedTime));

               if($finish<$endTime){

                   break;

               }

               $dateArray[$counter]['key'] = date('D d', $endTime); 

               $dateArray[$counter]['value'] = date('Y-m-d', $endTime); 

               $counter++;

               

                   if (date('H') < 22 && date('H') > 9) { 

                        $k+=1;  

                   }else{   

                        

                   }

                

           }



           return $dateArray;

    }

    

    

    public static function SendPushNotifications($token,$title,$body,$sound=true){

        $ch = curl_init("https://fcm.googleapis.com/fcm/send"); 

          $notification = array('title' =>$title , 'body' => $body, 'vibrate'=> true, 'sound'=> $sound, 'content-available' => true, 'priority' => 'high'); 

          $data = array('title' => $title, 'body' => $body);

          $arrayToSend = array('to' => $token, 'notification' => $notification, 'data' => $data);

          

          $json = json_encode($arrayToSend); 

           $headers = array();

           $headers[] = 'Content-Type: application/json';

           $headers[] = 'Authorization: key=AIzaSyB_7hwfe40YKXVUAVUOF6T5sVL4pNUkPVc';     

           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");   

           curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

           curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);

           

           curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, true);  

           curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

           curl_setopt($ch, CURLOPT_POST, 1);

      

          $response = curl_exec($ch);

          curl_close($ch);

          

          return $response ; 

              

      }     

 

}

