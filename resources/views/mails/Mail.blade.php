<!DOCTYPE html>
<html>

<head>
    <title>Appointment Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;">

    <a href="/" style="text-decoration: none; color: inherit; display: block; background: linear-gradient(to right, #6f0091, transparent); padding: 10px; border-radius: 5px; width: 100%;">
        <img src="https://i.imgur.com/RWwanDk.png" alt="BISU Logo" style="display: block; height: 2.1rem; float: left; margin-right: 10px;">
        <div style="display: block;">
            <span style="font-size: 1rem; color: #fdfdfd; font-weight: 400; display: block;">BOHOL ISLAND STATE UNIVERSITY</span>
            <span style="font-size: 0.875rem; color: #dadada; font-weight: 300;">
                <strong style="color: #ff9d00;">B</strong>alance |
                <strong style="color: #ff9d00;">I</strong>ntegrity |
                <strong style="color: #ff9d00;">S</strong>tewardship |
                <strong style="color: #ff9d00;">U</strong>prightness
            </span>
        </div>
    </a>



    <div style="clear: both;"></div>

    <h1 style="color: #333;">Appointment Confirmation</h1>
    <p style="color: #555;">Thank you for your appointment request. Here are the details:</p>
    <ul style="color: #555;">
        <li>First Name: <strong>{{ $data['fName'] }}</strong></li>
        <li>Last Name: <strong>{{ $data['lName'] }}</strong></li>
        <li>Campus: <strong>{{ $data['campus'] }}</strong></li>
        <li>Request: <strong>{{ $data['request'] }}</strong></li>
        <li>Appointment Date: <strong>{{ $data['appdate'] }}</strong></li>
        <li>Tracking Code: <strong>{{ $data['tracking_code'] }}</strong></li>
    </ul>

    <p style="color: #555; margin-top: 20px;">Please do not reply to this email. This is an automated email.</p>
</body>

</html>
