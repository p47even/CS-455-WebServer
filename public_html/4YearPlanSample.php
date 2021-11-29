<html>
    <style>
        table{
            border:1.75px solid black;
            border-collapse:collapse;
            font-family:arial;
            background-color:lightcyan;
            padding:10px;
        }
        th{ /* Columns */
            border:1.5px solid black;
            border-collapse:collapse;
            font-family:arial;
            background-color:lightblue;
            padding:5px;
        }
        td{ /* Rows */
            border:1.5px solid black;
            border-collapse:collapse;
            font-family:arial;
            background-color:lightcyan;
            padding:10px;
        }
        td:empty::after{
            content: "\00a0";
        }
        p{
            font-size:15;
            font-family:arial;
        }
        </style>
    <head>
        <title>Four Year Plan</title>
</head>
<body style = "background-color:linen">
    <h1 style = "color:beige;font-family:arial;background-color:maroon;text-align:center"> Four Year Plan </h1>
    <p>FirstName LastName</p>
    <p>Major(s): Computer Science (CSCI)</p>
    <table>
        <tr>
            <th colspan = "2">Freshman</th>
            <th colspan = "2">Sophomore</th>
            <th colspan = "2">Junior</th>
            <th colspan = "2">Senior</th>
        </tr>
        <tr>
            <th>Fall</th>
            <th>Spring</th>
            <th>Fall</th>
            <th>Spring</th>
            <th>Fall</th>
            <th>Spring</th>
            <th>Fall</th>
            <th>Spring</th>
        <tr> <!--Row 1 -->
            <td>101 Introduction to Computer Science</td>
            <td>261 Computer Science II</td>
            <td>281 Assembly Language and Computer Architecture</td>
            <td>361 Algorithms and Data Structures</td>
            <td></td>
            <td></td>
            <td></td>
            <td>440 Capstone in Computer Science</td>
        </tr>
        <tr> <!--Row 2 -->
            <td></td>
            <td></td>
            <td>291 Programming Language Paradigms</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr> <!--Row 3 -->
            <td></td>
            <td></td>
            <td>240 Software Engineering</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr> <!--Row 3 -->
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</body>
</html>