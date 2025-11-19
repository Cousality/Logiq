<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LOGIQ</title>

    <style>
        body {
            background-color: rgba(76, 32, 32, 1);
            margin: 0;
            padding: 0;
            font-family: 'Inria Serif', serif;
            color: white;
        }

        h1 {
            font-size: 60px;
            text-align: center;
            margin-top: 40px;
        }

        .about-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 40px;
            font-size: 20px;
            line-height: 1.6;
        }

        .team-section {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px 40px;
        }

        .team-section h2 {
            font-size: 35px;
            text-align: center;
            margin-bottom: 20px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .team-card {
            background: white;
            color: #310E0E;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-size: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    @include('Frontend.components.navbar')

    <main>

        <h1>About Us</h1>

        <!-- Description / Project Purpose -->
        <section class="about-section">
            <p>
                LogIQ is designed as a fully functional e-commerce platform created for puzzle enthusiasts of all ages. 
                Our goal is to provide a responsive and user-friendly space where customers can browse and filter products, 
                submit queries, place orders, and track their previous purchases—all in one seamless experience.
            </p>
        </section>

        <!-- Our Team -->
        <section class="team-section">
            <h2>Our Team</h2>

            <div class="team-grid">

                <div class="team-card">Haaris Ibrahim — 240373645</div>
                <div class="team-card">Cole Bailey — 230107571</div>

                <div class="team-card">Benedict Okonkwo — 240367541</div>
                <div class="team-card">Abderrahmane Laoubi — 230159972</div>

                <div class="team-card">Jadhushaya Nithiyananthan — 240120980</div>
                <div class="team-card">Iman Abbas El Ber — 240090339</div>

                <div class="team-card">Ian Weng — 240171959</div>
                <div class="team-card">Ibrahim Shah — 240278797</div>

            </div>
        </section>

        <!-- Our Values -->
        <section class="team-section">
            <h2>Our Values</h2>

            <div class="team-grid">

                <div class="team-card">
                    <strong>Curiosity</strong><br>
                    We encourage exploration, creativity, and a love for learning through problem-solving.
                </div>

                <div class="team-card">
                    <strong>Quality</strong><br>
                    We deliver reliable, well-crafted products and features that meet the highest standards.
                </div>

                <div class="team-card">
                    <strong>Accessibility</strong><br>
                    Our platform is designed for all ages, ensuring an intuitive and inclusive experience.
                </div>

                <div class="team-card">
                    <strong>Innovation</strong><br>
                    We continuously improve LogIQ with new ideas that enhance the puzzle-shopping experience.
                </div>

                <div class="team-card">
                    <strong>Community</strong><br>
                    We value puzzle lovers everywhere and aim to create a warm, supportive environment.
                </div>

                <div class="team-card">
                    <strong>Integrity</strong><br>
                    We operate with transparency, respect, and fairness across all interactions.
                </div>

                <div class="team-card">
                    <strong>Dedication</strong><br>
                    Our team works with passion and commitment to deliver the best possible experience.
                </div>

            </div>
        </section>

    </main>

    {{-- FOOTER --}}
    @include('Frontend.components.footer')

</body>
</html>
