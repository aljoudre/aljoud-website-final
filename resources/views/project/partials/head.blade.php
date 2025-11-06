<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->translate('name') }} - Aljoud Real Estate</title>
    <!-- Professional Fonts: Cairo for Arabic/English -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/final_style.css') }}">
    <style>
        * {
            direction: rtl !important;
        }
        .gallery-container {
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
        }
        .gallery-item {
            scroll-snap-align: center;
        }
        .gallery-container::-webkit-scrollbar {
            display: none;
        }
        .amenity-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .amenity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 90, 88, 0.15);
        }
        .stat-card {
            background: linear-gradient(135deg, #005A58 0%, #004a40 100%);
        }
    </style>
</head>
<body class="bg-[#f8f7f3]">

