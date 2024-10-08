<!DOCTYPE html>
<html>

<head>
    <title>Appointment Approved</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;">

    <div style="clear: both;"></div>
    <p style="color: #555;">Your appointment has been approved. Please ensure that you obtain your request on the day of your appointment.</p>
    <p>Appointment Date: <strong>{{ $data['appdate'] }}</strong></p>
    <p>Request: <strong>{{ $data['request'] }}</strong></p>
    <p><br>If you have any questions please message the registrar thru here bisuregistrar.rf.gd</p>
    <a
        style="text-decoration: none; color: inherit; display: block; background: linear-gradient(to right, #6f0091, transparent); padding: 10px; border-radius: 5px; width: 100%;">
        <img src="https://i.imgur.com/RWwanDk.png" alt=""
            style="display: block; height: 2.1rem; float: left; margin-right: 10px;">
        <div style="display: block;">
            <span style="font-size: 1rem; color: #fdfdfd; font-weight: 400; display: block;">BOHOL ISLAND STATE
                UNIVERSITY</span>
            <span style="font-size: 0.875rem; color: #dadada; font-weight: 300;">
                <strong style="color: #ff9d00;">B</strong>alance |
                <strong style="color: #ff9d00;">I</strong>ntegrity |
                <strong style="color: #ff9d00;">S</strong>tewardship |
                <strong style="color: #ff9d00;">U</strong>prightness
            </span>
        </div>
    </a>

    <p style="color: #555; margin-top: 20px;">Please do not reply to this email. This is an automated email.</p>
</body>

</html>
