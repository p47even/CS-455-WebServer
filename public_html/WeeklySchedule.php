<!DOCTYPE html>
<html>
<body>
    <?php

    try {

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query_str = $db->query("SELECT * FROM Enroll NATURAL JOIN IsMeeting WHERE studentID = 1;");
        $classes = $db->query($query_str);
         
        foreach($classes as $class){
            echo "$class[meetTime] $class[meetDay] $class[className] $class[location]\t";
        }
      
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>

<style>
            /**SOURCES: https://codepen.io/m0skar/pen/WjBdVW**/
            * {
            margin: 0;
            border: 0;
            }

            body {
            flex-direction: column;
            display: flex;
            align-items: center;
            align-content: center;
            justify-content: center;
            font-family: "DINPro", "Helvetica Neue", sans-serif;
            padding: 3rem;
            margin: 0;
            background: #fafafa;
            box-sizing: border-box;
            height: 100vh;

            }

            .offset {

            }

            .outer {
            position:relative;
            }

            .calendar {
                margin: 0 auto;
            max-width: 1280px;
            min-width: 500px;

            box-shadow: 0px 30px 50px rgba(0, 0, 0, 0.2) ,0px 3px 7px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            }
            .wrap {

            overflow-x: hidden;
            overflow-y: scroll;
                max-width: 1280px;
            height: 500px;
            border-radius: 8px;
            }

            thead {
                box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
            }

            thead th {

            text-align: center;
            width: 100%;

            }

            header {
            background:maroon;
            padding: 1rem;
            color:white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px 8px 0px 0px;
            }

            header h1 {
            font-size: 1.25rem;
            text-align: center;
            font-weight: normal;

            }
            tbody {
                position: relative;
            top: 100px;
            }
            table {
            background: #fff;
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            table-layout: fixed;

            }



            .headcol {
            width: 60px;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.5);
            padding: 0.25rem 0;
            text-align: center;
            border: 0;
            position: relative;
            top: -12px;
            border-bottom: 1px solid transparent;
            }

            thead th {
            font-size: 1rem;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.9);
            padding: 1rem;
            }

            thead {
                z-index: 2;
                background: white;
                border-bottom: 2px solid #ddd;

            }

            tr, tr td {
            height: 20px;
            }
            td {
            text-align: center;
            }
            tr:nth-child(odd) td:not(.headcol) {
            border-bottom: 1px solid #e8e8e8;
            }

            tr:nth-child(even) td:not(.headcol) {
            border-bottom: 1px solid #eee;
            }

            tr td {
            border-right: 1px solid #eee;
            padding: 0;
            white-space: none;
            word-wrap: nowrap;
            }

            tbody tr td {
            position: relative;
            vertical-align: top;
            height: 40px;
            padding: 0.25rem 0.25rem 0 0.25rem;
            width: auto;

            }

            .secondary {
            color: rgba(0, 0, 0, 0.4);
            }


            .checkbox {
            display: none;
            }

            .checkbox + label {
                border: 0;
                outline: 0;
                width: 100px;
                heigth: 100px;
                background: white;
                color: transparent;
                display:block;
            display: none;
            }

            .checkbox:checked + label {
                border: 0;
                outline: 0;
                width: 100%;
                heigth: 100%;
                background: red;
                color: transparent;
                display: inline-block;
            }

            .event {
            background: gray;
            color: white;
            border-radius: 2px;
            text-align: left;
            font-size: 0.875rem;
            z-index: 2;
            padding: 0.5rem;
            overflow-x: hidden;
            transition: all 0.2s;
            cursor: pointer;
            }

            .event:hover {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            background: #00B4FC;
            }

            .event.double {
            height: 200%;
            }

            /**
            thead {
                tr {
                display: block;
                position: relative;
                }
            }
            tbody {
                display: block;
                overflow: auto;
                width: 800px;
                height: 100%;
            }
            */


            button.secondary {
            border: 1px solid rgba(0, 0, 0, 0.1);
            background: white;
            padding: 0.5rem 0.75rem;
            font-size: 14px;
            border-radius: 2px;
            color: rgba(0, 0, 0, 0.5);
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-weight: 500;
            }

            button.secondary:hover {
            background: #fafafa;
            }
            button.secondary:active {
            box-shadow: none;
            }
            button.secondary:focus {
            outline: 0;
            }

            tr td:nth-child(2), tr td:nth-child(3), .past {
            background: #fafafa;
            }

            .today {
            color: red;
            }

            .now {
            box-shadow: 0px -1px 0px 0px red;
            }

            .icon {
            font-size: 1.5rem;
            margin: 0 1rem;
            text-align: center;
            cursor: pointer;
            vertical-align: middle;
            position: relative;
            top: -2px;
            }

            .icon:hover {
            color: red;
            }
        </style>
        <div class="calendar">
        
            <header>
                <button class="secondary" style="align-self: flex-start; flex: 0 0 1" href="Das">Menu</button>
                <div class="calendar__title" style="display: flex; justify-content: center; align-items: center">
                <div class="icon secondary chevron_left">‹</div>
                <h1 class="" style="flex: 1;"><span></span><strong>Weekly Schedule</strong></h1>
                <div class="icon secondary chevron_left">›</div>
                </div> 
                <div style="align-self: flex-start; flex: 0 0 1"></div>
            </header>
            
            <div class="outer">
        
            
            <table>
            <thead>
            <tr>
                <th class="headcol"></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th class="secondary">Saturday</th>
                <th class="secondary">Sunday</th>
            </tr>
            </thead>
            </table>
        
        <div class="wrap"> 
            <table class="offset">
        
            <tbody>
            <tr>
                <td class="headcol">8:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><div><input/><label></label></div></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">9:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">10:00</td>
                <td></td>
                <td></td>
                <td><div><input/><label></label></div></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">11:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">12:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">13:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">14:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">15:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">16:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">17:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol">18:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
        </div>
</body>
</html>
