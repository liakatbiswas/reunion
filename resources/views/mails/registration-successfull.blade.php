<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>

    <style>
        body {
            background: #eef2f7;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .email-wrapper {
            max-width: 680px;
            background: #ffffff;
            margin: auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.12);
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1a73e8, #0057c2);
            padding: 25px 30px;
            text-align: center;
            color: #fff;
        }

        .header img {
            height: 60px;
            margin-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
        }

        /* Content */
        .content {
            padding: 30px;
        }

        h2 {
            font-size: 22px;
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #f7f9fc;
            padding: 20px;
            border-radius: 12px;
            border-left: 5px solid #1a73e8;
            margin-bottom: 25px;
        }

        .profile-box img {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
            border: 3px solid #e1e8f0;
        }

        .profile-box h3 {
            margin: 0;
            font-size: 20px;
            color: #1a1a1a;
        }

        .profile-box p {
            margin: 4px 0;
            color: #555;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table td {
            padding: 10px 5px;
            font-size: 16px;
            border-bottom: 1px solid #eaeaea;
        }

        table td:first-child {
            width: 35%;
            font-weight: bold;
            color: #333;
        }

        /* Footer */
        .footer {
            background: #f1f4f9;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e6e6e6;
        }

        @media(max-width: 600px) {
            .profile-box {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

</head>

<body>

    <div class="email-wrapper">

        <!-- Header -->
        <div class="header">
            <img src="{{ asset('logo.jpg') }}" alt="Logo">
            {{-- <h1>Registration Successful</h1> --}}
            <h1>Registration Information</h1>
        </div>

        <!-- Content -->
        <div class="content">

            <h2>Thank you for registering!</h2>
            <span style="color: red; text-align: center">You will get Registration Successful mail shortly.</span>

            <!-- Profile -->
            <div class="profile-box">
                <img src="{{ url('storage/' . $credentials->photo) }}" alt="Photo">

                <div>
                    <h3>{{ $credentials->name }}</h3>
                    <p>Registration ID: <strong>{{ $credentials->regi_id }}</strong></p>
                </div>
            </div>

            <!-- Details Table -->
            <table>
                <tr>
                    <td>Name</td>
                    <td>{{ $credentials->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $credentials->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $credentials->phone }}</td>
                </tr>
                <tr>
                    <td>Occupation</td>
                    <td>{{ $credentials->occupation }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $credentials->gender }}</td>
                </tr>
                <tr>
                    <td>Member Type</td>
                    <td>{{ $credentials->member_type }}</td>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>{{ $credentials->amount }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            © {{ date('Y') }} All rights reserved • Your Organization Name
        </div>

    </div>

</body>

</html>
