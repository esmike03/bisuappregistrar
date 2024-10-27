<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; color: #555;">

    <div style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); max-width: 600px; margin: auto;">
        <h2 style="color: #6f0091; margin-bottom: 10px;">Appointment Confirmation</h2>
        <p>Thank you for your appointment request. Here are the details:</p>

        <ul style="list-style-type: none; padding: 0;">
            <li style="margin: 5px 0;">First Name: <strong>{{ $data['fName'] }}</strong></li>
            <li style="margin: 5px 0;">Last Name: <strong>{{ $data['lName'] }}</strong></li>
            <li style="margin: 5px 0;">Campus: <strong>{{ $data['campus'] }}</strong></li>
            <li style="margin: 5px 0;">Request: <strong>{{ $data['request'] }}</strong></li>
            <li style="margin: 5px 0;">Appointment Date: <strong>{{ $data['appdate'] }}</strong></li>
            <li style="margin: 5px 0;">Tracking Code: <strong>{{ $data['tracking_code'] }}</strong></li>
        </ul>

        <p style="margin-top: 20px; font-size: 0.875rem; color: #777;">If you have any questions, please message the registrar at <a href="mailto:bisuregistrar.rf.gd" style="color: #6f0091;">bisuregistrar.rf.gd</a>.</p>

        <a href="#" style="text-decoration: none; display: block; background: linear-gradient(to right, #60027c, transparent); padding: 10px; border-radius: 5px; color: #fdfdfd; margin-top: 20px;">
            <img src="https://i.imgur.com/RWwanDk.png" alt="Bohol Island State University" style="display: block; height: 2.1rem; float: left; margin-right: 10px;">
            <span style="font-size: 1rem; color: #fdfdfd; font-weight: 400; display: block;">BOHOL ISLAND STATE UNIVERSITY</span>
            <span style="font-size: 0.875rem; color: #dadada; font-weight: 300;">
                <strong style="color: #ff9d00;">B</strong>alance |
                <strong style="color: #ff9d00;">I</strong>ntegrity |
                <strong style="color: #ff9d00;">S</strong>tewardship |
                <strong style="color: #ff9d00;">U</strong>prightness
            </span>
        </a>

        <p style="margin-top: 20px; color: #777;">Please do not reply to this email. This is an automated message.</p>
    </div>

</body>

</html>
