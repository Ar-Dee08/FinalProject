<?php
include 'includes/header.php';
include 'user_middleware.php';
include '../vscode/dbcon.php';
?>


<body class="logo-bg-2">
    <div class="customer-container">
    <h1 style="font-family: 'Inter', sans-serif; font-weight: 900; color: black; text-align: center; ">ABOUT US</h1>
    <h4 style="font-family: 'Inter', sans-serif; font-weight: bold; color: black; text-align: center;">Student Society on Information Technology Education</h4>
    <p class="lead" style="font-family: 'Inter', sans-serif; font-weight: bold; text-align: center;">
                    Brightening Futures Through IT Education
                </p>
        <div class="container">
            <!-- About Us Intro -->
            <div class="content-box text-center">
                <img src="images/SSITE-GRID.png" alt="SSITE Photo" style="max-width: 100%; height: auto; margin-bottom: 13px;"><br>
                <p style="text-align: left;">
                    The Student Society on Information Technology Education (𝗦𝗦𝗜𝗧𝗘) helps IT students grow and succeed by promoting quality education and offering support through seminars, workshops, and conferences. SSITE embraces technology as a key tool for learning and hosts events that provide real-world problem-solving experiences, while keeping members informed through its online presence.
                </p>
                <p style="text-align: left;">
                    SSITE welcomes all students, encouraging diverse ideas and collaboration. More than just an organization, SSITE is a community that prepares future IT leaders for success in the digital age.
                </p>
                
            </div>

            <!-- Mission Section -->
            <div class="content-box">
                <h2 style="font-family: 'Inter', sans-serif; font-weight: 700; color: black; text-align: center;">Mission</h2>
                <p style="text-align: left;">
                    The mission of the Student Society on Information Technology Education (SSITE) is to advance the promotion of quality information technology education. The society is dedicated to fostering an environment where students can thrive academically and professionally through innovative programs, hands-on experiences, and community engagement.
                </p>
                <ul>
                    <li><b>Educational Support:</b> Providing resources and mentorship to enhance academic success.</li>
                    <li><b>Professional Development:</b> Hosting workshops and events to build career-ready skills.</li>
                    <li><b>Community Building:</b> Creating a collaborative environment for IT students to network and grow.</li>
                    <li><b>Technology:</b> Leveraging cutting-edge tools and platforms for immersive learning experiences.</li>
                </ul>
            </div>

            <!-- Vision Section -->
            <div class="content-box">
                <h2 style="font-family: 'Inter', sans-serif; font-weight: 700; color: black; text-align: center;">Vision</h2>
                <p style="text-align: left;">
                    SSITE aims to empower students to become innovative IT leaders. We envision a future where every member has advanced tech skills, collaborates, and embraces lifelong learning. SSITE fosters a supportive community focused on academic excellence, professional growth, and a passion for technology.
                </p>
                <ul>
                    <li><b>Outreach and Engagement:</b> Building connections within the IT community.</li>
                    <li><b>Leadership Opportunities:</b> Preparing students for roles that drive innovation and change.</li>
                    <li><b>Online Presence:</b> Maintaining a digital hub to share resources and updates.</li>
                    <li><b>Online Membership:</b> Providing accessible membership options for diverse participants.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <style>
        .customer-container {
            width: 70%;
            padding: 50px 15px;
            background-color: #CEDFE3;
            padding: 30px;    
            border-radius: 5px;
            max-width: 95%;
            margin: 3% auto;    
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            font-family: 'Inter', sans-serif;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .content-box {
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
    </style>
