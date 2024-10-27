<!DOCTYPE html>
<html>

<head>
    <title>Email Verification Code</title>
</head>

<body>
    <p style="font-family: Arial, sans-serif; font-size: 16px; color: #333; margin-bottom: 10px;">
        Your verification code is:
    </p>
    <p style="
        background-color: #60027c;
        color: #d69e2e;
        font-size: 24px;
        font-weight: bold;
        padding: 16px;
        margin: 16px 0;
        text-align: center;
        border-radius: 8px;
        border: 2px solid #db9509;
        font-family: 'Courier New', Courier, monospace;
    ">
        {{ $code }}
    </p>
    <p style="font-family: Arial, sans-serif; font-size: 16px; color: #333;">
        Please enter this code to verify your email address.
    </p>

    <a
        style="text-decoration: none; color: inherit; display: block; background: linear-gradient(to right, #60027c, transparent); padding: 10px; border-radius: 5px; width: 100%;">
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
</body>

</html>
