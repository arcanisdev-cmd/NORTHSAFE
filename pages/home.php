<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - NORTHSAFE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cream': '#FFF8F0',
                        'cream-dark': '#F5E6D3',
                        'primary': '#2B7FE3',
                        'secondary': '#64748B',
                        'success': '#10B981',
                        'danger': '#DC2626',
                        'warning': '#F59E0B',
                        'info': '#06B6D4',
                    },
                    fontFamily: {
                        'sans': ['Plus Jakarta Sans', 'sans-serif'],
                        'display': ['Space Grotesk', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FFF8F0;
        }

        /* Mobile menu animation */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.active {
            max-height: 500px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <span class="font-display font-bold text-2xl text-gray-800">NORTHSAFE</span>
                    <span class="text-sm text-secondary hidden sm:block">Smart Community Hazard Reporting</span>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="home.php"
                        class="flex items-center space-x-2 px-4 py-2 bg-primary text-white rounded-lg font-semibold transition-colors">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                    <a href="dashboard.php"
                        class="flex items-center space-x-2 px-4 py-2 text-secondary hover:text-primary hover:bg-cream-dark rounded-lg font-semibold transition-colors">
                        <i class="fas fa-chart-line"></i>
                        <span>My Reports</span>
                    </a>
                    <a href="hazard-map.html"
                        class="flex items-center space-x-2 px-4 py-2 text-secondary hover:text-primary hover:bg-cream-dark rounded-lg font-semibold transition-colors">
                        <i class="fas fa-map"></i>
                        <span>Map</span>
                    </a>
                    <a href="report-hazard.html"
                        class="flex items-center space-x-2 px-4 py-2 text-secondary hover:text-primary hover:bg-cream-dark rounded-lg font-semibold transition-colors">
                        <i class="fas fa-plus-circle"></i>
                        <span>Report</span>
                    </a>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button"
                        class="md:hidden text-secondary hover:text-primary transition-colors" aria-label="Toggle menu">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>

                    <!-- Notifications -->
                    <button class="relative text-secondary hover:text-primary transition-colors"
                        aria-label="Notifications">
                        <i class="far fa-bell text-2xl"></i>
                        <span
                            class="absolute -top-1 -right-1 w-5 h-5 bg-danger text-white text-xs rounded-full flex items-center justify-center font-bold">3</span>
                    </button>

                    <!-- User Account -->
                    <div class="relative group hidden md:block">
                        <button id="userMenuButton"
                            class="flex items-center space-x-3 px-3 py-2 hover:bg-cream-dark rounded-lg transition-colors"
                            aria-label="User menu">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-primary to-info rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                            <div class="hidden lg:block text-left">
                                <p class="text-sm font-semibold text-gray-800"><?= $_SESSION["fullname"];?></p>
                                <p class="text-xs text-success flex items-center">
                                    <i class="fas fa-star mr-1"></i>
                                    1,250 pts
                                </p>
                            </div>
                            <i class="fas fa-chevron-down text-secondary text-sm"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                            <a href="profile.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cream-dark">
                                <i class="fas fa-user mr-2"></i>Profile
                            </a>
                            <a href="settings.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cream-dark">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <a href="my-reports.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cream-dark">
                                <i class="fas fa-trophy mr-2"></i>My Reports
                            </a>
                            <hr class="my-2">
                            <a href="#" onclick="logout(); return false;"
                                class="block px-4 py-2 text-sm text-danger hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu md:hidden border-t border-gray-200">
                <div class="py-4 space-y-2">
                    <a href="home.html"
                        class="flex items-center space-x-2 px-4 py-3 bg-primary text-white rounded-lg font-semibold">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                    <a href="dashboard.html"
                        class="flex items-center space-x-2 px-4 py-3 text-secondary hover:bg-cream-dark rounded-lg font-semibold">
                        <i class="fas fa-chart-line"></i>
                        <span>My Reports</span>
                    </a>
                    <a href="hazard-map.html"
                        class="flex items-center space-x-2 px-4 py-3 text-secondary hover:bg-cream-dark rounded-lg font-semibold">
                        <i class="fas fa-map"></i>
                        <span>Map</span>
                    </a>
                    <a href="report-hazard.html"
                        class="flex items-center space-x-2 px-4 py-3 text-secondary hover:bg-cream-dark rounded-lg font-semibold">
                        <i class="fas fa-plus-circle"></i>
                        <span>Report</span>
                    </a>
                    <div class="border-t border-gray-200 pt-2 mt-2">
                        <div class="flex items-center space-x-3 px-4 py-3">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-primary to-info rounded-full flex items-center justify-center text-white font-bold">
                                JD
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800"><?= $_SESSION["fullname"];?></p>
                                <p class="text-xs text-success flex items-center">
                                    <i class="fas fa-star mr-1"></i>
                                    1,250 pts
                                </p>
                            </div>
                        </div>
                        <a href="profile.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cream-dark">
                            <i class="fas fa-user mr-2"></i>Profile
                        </a>
                        <a href="settings.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cream-dark">
                            <i class="fas fa-cog mr-2"></i>Settings
                        </a>
                        <a href="my-reports.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-cream-dark">
                            <i class="fas fa-trophy mr-2"></i>My Reports
                        </a>
                        <a href="#" onclick="logout(); return false;"
                            class="block px-4 py-2 text-sm text-danger hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Section -->
        <div class="text-center mb-10">
            <h1 class="font-display font-bold text-4xl md:text-5xl text-gray-800 mb-4">
                Keep Your Community Safe
            </h1>
            <p class="text-lg md:text-xl text-secondary max-w-3xl mx-auto mb-8">
                Report hazards, stay informed, and help make North Caloocan City safer for everyone.
            </p>

            <!-- Report Button -->
            <a href="report-hazard.html"
                class="inline-flex items-center space-x-3 px-8 py-4 bg-danger hover:bg-red-700 text-white rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                <i class="fas fa-camera text-2xl"></i>
                <span>Report a Hazard</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Feed -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Pinned Announcement -->
                <div
                    class="bg-gradient-to-r from-red-500 to-orange-500 rounded-2xl p-6 text-white shadow-lg border-4 border-red-600">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-4xl"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <i class="fas fa-thumbtack"></i>
                                <span class="font-bold text-sm uppercase">Pinned Announcement</span>
                            </div>
                            <h3 class="font-display font-bold text-2xl mb-2">
                                Typhoon Warning - Evacuation Advisory
                            </h3>
                            <p class="text-white/90 mb-4">
                                Typhoon "Maring" is expected to make landfall in the next 24 hours. Residents living
                                near lakes, rivers, and low-lying areas are advised to evacuate immediately to
                                designated evacuation centers. Barangays 15, 23, 45, and 67 are under mandatory
                                evacuation orders.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Multiple Barangays
                                </span>
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold">
                                    <i class="far fa-clock mr-1"></i>Posted 2 hours ago
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <a href="evacuation-centers.html"
                                    class="px-4 py-2 bg-white text-red-600 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-map-marked-alt mr-2"></i>View Evacuation Centers
                                </a>
                                <a href="typhoon-info.html"
                                    class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-lg font-bold hover:bg-white/30 transition-colors">
                                    <i class="fas fa-info-circle mr-2"></i>More Info
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Hazards Title -->
                <div class="flex items-center justify-between">
                    <h2 class="font-display font-bold text-2xl text-gray-800">Recent Hazards</h2>
                    <select
                        class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-secondary focus:outline-none focus:ring-2 focus:ring-primary"
                        aria-label="Sort hazards">
                        <option>Most Recent</option>
                        <option>Most Critical</option>
                        <option>Most Upvoted</option>
                        <option>Nearest to Me</option>
                    </select>
                </div>

                <!-- Hazard Card 1 - Critical -->
                <a href="hazard-detail-new.html"
                    class="block bg-white rounded-2xl border-2 border-gray-200 hover:border-primary shadow-sm hover:shadow-md transition-all overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span
                                        class="px-3 py-1 bg-red-100 text-danger rounded-full text-xs font-bold uppercase">
                                        <i class="fas fa-circle text-xs mr-1"></i>Critical
                                    </span>
                                    <span class="px-3 py-1 bg-green-100 text-success rounded-full text-xs font-bold">
                                        <i class="fas fa-check-circle mr-1"></i>Verified
                                    </span>
                                </div>
                                <h3
                                    class="font-display font-bold text-xl text-gray-800 mb-2 hover:text-primary cursor-pointer">
                                    Large Pothole on Main Road Causing Traffic Delays
                                </h3>
                                <p class="text-secondary mb-3 line-clamp-2">
                                    Dangerous pothole discovered on the main road intersection. Multiple vehicles have
                                    been damaged. Immediate repair needed to prevent accidents.
                                </p>

                                <!-- Hazard Meta Info -->
                                <div class="flex flex-wrap items-center gap-3 text-sm text-secondary mb-4">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                        <span>0.5 km away • Corner of Main St & 5th Ave, Brgy 123</span>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-secondary">
                                    <div class="flex items-center space-x-2">
                                        <img src="https://ui-avatars.com/api/?name=Juan+Dela+Cruz&background=6366f1&color=fff"
                                            class="w-6 h-6 rounded-full" alt="Juan Dela Cruz">
                                        <span class="font-semibold"><?= $_SESSION["fullname"];?></span>
                                        <span
                                            class="px-2 py-0.5 bg-primary/10 text-primary rounded text-xs font-bold">Level
                                            5</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center space-x-1">
                                        <i class="far fa-clock"></i>
                                        <span>2 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Hazard Image Thumbnail -->
                            <div class="ml-4 flex-shrink-0">
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center overflow-hidden">
                                    <i class="fas fa-image text-4xl text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Category Tag -->
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 bg-warning/10 text-warning rounded-full text-sm font-semibold">
                                <i class="fas fa-wrench mr-1"></i>Road Damage
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-4">
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Upvote">
                                    <i class="fas fa-thumbs-up text-lg"></i>
                                    <span class="font-semibold">45</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Downvote">
                                    <i class="fas fa-thumbs-down text-lg"></i>
                                    <span class="font-semibold">2</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Comments">
                                    <i class="far fa-comment text-lg"></i>
                                    <span class="font-semibold">12</span>
                                </button>
                            </div>
                            <span
                                class="px-4 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors">
                                View Details
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Hazard Card 2 - High Priority -->
                <a href="hazard-detail-new.html"
                    class="block bg-white rounded-2xl border-2 border-gray-200 hover:border-primary shadow-sm hover:shadow-md transition-all overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span
                                        class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-bold uppercase">
                                        <i class="fas fa-circle text-xs mr-1"></i>High
                                    </span>
                                </div>
                                <h3
                                    class="font-display font-bold text-xl text-gray-800 mb-2 hover:text-primary cursor-pointer">
                                    Broken Street Light - Safety Concern
                                </h3>
                                <p class="text-secondary mb-3 line-clamp-2">
                                    Street light has been non-functional for 3 days, creating a dark spot that poses
                                    safety risks for pedestrians at night.
                                </p>

                                <div class="flex flex-wrap items-center gap-3 text-sm text-secondary mb-4">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                        <span>1.2 km away • Manila Ave, Brgy 45</span>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-secondary">
                                    <div class="flex items-center space-x-2">
                                        <img src="https://ui-avatars.com/api/?name=Maria+Santos&background=ec4899&color=fff"
                                            class="w-6 h-6 rounded-full" alt="Maria Santos">
                                        <span class="font-semibold">Maria Santos</span>
                                        <span
                                            class="px-2 py-0.5 bg-primary/10 text-primary rounded text-xs font-bold">Level
                                            3</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center space-x-1">
                                        <i class="far fa-clock"></i>
                                        <span>5 hours ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="ml-4 flex-shrink-0">
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-lightbulb text-4xl text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 bg-info/10 text-info rounded-full text-sm font-semibold">
                                <i class="fas fa-lightbulb mr-1"></i>Infrastructure
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-4">
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Upvote">
                                    <i class="fas fa-thumbs-up text-lg"></i>
                                    <span class="font-semibold">28</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Downvote">
                                    <i class="fas fa-thumbs-down text-lg"></i>
                                    <span class="font-semibold">1</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Comments">
                                    <i class="far fa-comment text-lg"></i>
                                    <span class="font-semibold">7</span>
                                </button>
                            </div>
                            <span
                                class="px-4 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors">
                                View Details
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Hazard Card 3 - Medium Priority -->
                <a href="hazard-detail-new.html"
                    class="block bg-white rounded-2xl border-2 border-gray-200 hover:border-primary shadow-sm hover:shadow-md transition-all overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span
                                        class="px-3 py-1 bg-yellow-100 text-warning rounded-full text-xs font-bold uppercase">
                                        <i class="fas fa-circle text-xs mr-1"></i>Medium
                                    </span>
                                    <span class="px-3 py-1 bg-green-100 text-success rounded-full text-xs font-bold">
                                        <i class="fas fa-check-circle mr-1"></i>Verified
                                    </span>
                                </div>
                                <h3
                                    class="font-display font-bold text-xl text-gray-800 mb-2 hover:text-primary cursor-pointer">
                                    Overflowing Garbage Bins
                                </h3>
                                <p class="text-secondary mb-3 line-clamp-2">
                                    Multiple garbage bins are overflowing on Central Street. Creating unsanitary
                                    conditions and attracting pests.
                                </p>

                                <div class="flex flex-wrap items-center gap-3 text-sm text-secondary mb-4">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                        <span>0.8 km away • Central St, Brgy 78</span>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-secondary">
                                    <div class="flex items-center space-x-2">
                                        <img src="https://ui-avatars.com/api/?name=Pedro+Reyes&background=10b981&color=fff"
                                            class="w-6 h-6 rounded-full" alt="Pedro Reyes">
                                        <span class="font-semibold">Pedro Reyes</span>
                                        <span
                                            class="px-2 py-0.5 bg-primary/10 text-primary rounded text-xs font-bold">Level
                                            7</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center space-x-1">
                                        <i class="far fa-clock"></i>
                                        <span>1 day ago</span>
                                    </div>
                                </div>
                            </div>

                            <div class="ml-4 flex-shrink-0">
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-trash text-4xl text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 mb-4">
                            <span class="px-3 py-1 bg-success/10 text-success rounded-full text-sm font-semibold">
                                <i class="fas fa-leaf mr-1"></i>Sanitation
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-4">
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Upvote">
                                    <i class="fas fa-thumbs-up text-lg"></i>
                                    <span class="font-semibold">67</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Downvote">
                                    <i class="fas fa-thumbs-down text-lg"></i>
                                    <span class="font-semibold">3</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-secondary hover:text-primary transition-colors"
                                    aria-label="Comments">
                                    <i class="far fa-comment text-lg"></i>
                                    <span class="font-semibold">15</span>
                                </button>
                            </div>
                            <span
                                class="px-4 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg font-semibold transition-colors">
                                View Details
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Load More Button -->
                <div class="text-center">
                    <button
                        class="px-8 py-3 bg-white border-2 border-gray-300 hover:border-primary text-gray-700 hover:text-primary rounded-xl font-bold transition-all">
                        <i class="fas fa-sync-alt mr-2"></i>Load More Hazards
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Emergency Hotlines -->
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-phone-alt text-danger text-xl"></i>
                        <h3 class="font-display font-bold text-lg text-gray-800">Emergency Hotlines</h3>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-danger rounded-lg flex items-center justify-center">
                                    <i class="fas fa-phone text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">Emergency Response</p>
                                    <p class="text-xs text-secondary">911</p>
                                </div>
                            </div>
                            <a href="tel:911"
                                class="px-4 py-2 bg-danger hover:bg-red-700 text-white rounded-lg font-bold text-sm transition-colors">
                                Call
                            </a>
                        </div>

                        <div
                            class="flex items-center justify-between p-3 bg-orange-50 rounded-lg border border-orange-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-fire text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">Fire Department</p>
                                    <p class="text-xs text-secondary">(02) 426-0219</p>
                                </div>
                            </div>
                            <a href="tel:024260219"
                                class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-bold text-sm transition-colors">
                                Call
                            </a>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">Police Station</p>
                                    <p class="text-xs text-secondary">(02) 962-7771</p>
                                </div>
                            </div>
                            <a href="tel:029627771"
                                class="px-4 py-2 bg-primary hover:bg-blue-700 text-white rounded-lg font-bold text-sm transition-colors">
                                Call
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Hazard Map Widget -->
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-map text-primary text-xl"></i>
                        <h3 class="font-display font-bold text-lg text-gray-800">Hazard Map</h3>
                    </div>

                    <div
                        class="bg-gradient-to-br from-blue-100 to-green-100 rounded-xl h-48 flex items-center justify-center mb-4">
                        <div class="text-center">
                            <i class="fas fa-map-marked-alt text-6xl text-primary mb-2"></i>
                            <p class="text-secondary font-semibold">3 hazards within 1km</p>
                        </div>
                    </div>

                    <a href="hazard-map.html"
                        class="block w-full py-3 bg-primary hover:bg-blue-700 text-white text-center rounded-xl font-bold transition-colors">
                        <i class="fas fa-map mr-2"></i>View Full Map
                    </a>
                </div>

                <!-- Community Stats -->
                <div class="bg-gradient-to-br from-primary/10 to-info/10 rounded-2xl border-2 border-primary/20 p-6">
                    <h3 class="font-display font-bold text-lg text-gray-800 mb-4">Community Impact</h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-success rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check-circle text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-2xl text-gray-800">247</p>
                                    <p class="text-sm text-secondary">Hazards Resolved</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-warning rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-2xl text-gray-800">18</p>
                                    <p class="text-sm text-secondary">Active Reports</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-2xl text-gray-800">1,234</p>
                                    <p class="text-sm text-secondary">Active Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Tips -->
                <div class="bg-white rounded-2xl border-2 border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-lightbulb text-warning text-xl"></i>
                        <h3 class="font-display font-bold text-lg text-gray-800">Quick Tips</h3>
                    </div>

                    <ul class="space-y-3 text-sm text-secondary">
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check text-success mt-1"></i>
                            <span>Take clear photos of the hazard from multiple angles</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check text-success mt-1"></i>
                            <span>Include exact location details for faster response</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check text-success mt-1"></i>
                            <span>Upvote existing reports instead of duplicating</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-check text-success mt-1"></i>
                            <span>Follow up on your reports to track progress</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                        <span class="font-display font-bold text-xl text-gray-800">NORTHSAFE</span>
                    </div>
                    <p class="text-sm text-secondary">
                        Keeping North Caloocan City safe through community-driven hazard reporting.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-secondary">
                        <li><a href="about.html" class="hover:text-primary">About Us</a></li>
                        <li><a href="how-it-works.html" class="hover:text-primary">How It Works</a></li>
                        <li><a href="faq.html" class="hover:text-primary">FAQs</a></li>
                        <li><a href="contact.html" class="hover:text-primary">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-secondary">
                        <li><a href="privacy.html" class="hover:text-primary">Privacy Policy</a></li>
                        <li><a href="terms.html" class="hover:text-primary">Terms of Service</a></li>
                        <li><a href="guidelines.html" class="hover:text-primary">Community Guidelines</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4">Connect With Us</h4>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-10 h-10 bg-gray-200 hover:bg-primary rounded-lg flex items-center justify-center transition-colors group"
                            aria-label="Facebook">
                            <i class="fab fa-facebook text-gray-600 group-hover:text-white"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-200 hover:bg-primary rounded-lg flex items-center justify-center transition-colors group"
                            aria-label="Twitter">
                            <i class="fab fa-twitter text-gray-600 group-hover:text-white"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-200 hover:bg-primary rounded-lg flex items-center justify-center transition-colors group"
                            aria-label="Instagram">
                            <i class="fab fa-instagram text-gray-600 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-8 pt-6 text-center text-sm text-secondary">
                <p>&copy; 2026 NORTHSAFE. All rights reserved. Made with ❤️ for North Caloocan City</p>
            </div>
        </div>
    </footer>

    <script src="../assets/js/main.js"></script>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const icon = mobileMenuButton.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Authentication required - redirect if not logged in
        document.addEventListener('DOMContentLoaded', function () {
            // Check if user is authenticated
            const user = NORTHSAFE.Auth.getCurrentUser();

            // Get user initials
            const initials = user.name.split(' ').map(n => n[0]).join('');

            // Update desktop user info
            const desktopUserName = document.querySelector('.relative.group .text-sm.font-semibold.text-gray-800');
            const desktopUserInitials = document.querySelector('.relative.group .w-10.h-10.bg-gradient-to-br');
            const desktopUserPoints = document.querySelector('.relative.group .text-xs.text-success');

            if (desktopUserName) desktopUserName.textContent = user.name;
            if (desktopUserInitials) desktopUserInitials.textContent = initials;
            if (desktopUserPoints && user.points !== undefined) {
                desktopUserPoints.innerHTML = `<i class="fas fa-star mr-1"></i>${user.points.toLocaleString()} pts`;
            }

            // Update mobile menu user info
            const mobileUserName = document.querySelector('#mobile-menu .text-sm.font-semibold.text-gray-800');
            const mobileUserInitials = document.querySelector('#mobile-menu .w-10.h-10.bg-gradient-to-br');
            const mobileUserPoints = document.querySelector('#mobile-menu .text-xs.text-success');

            if (mobileUserName) mobileUserName.textContent = user.name;
            if (mobileUserInitials) mobileUserInitials.textContent = initials;
            if (mobileUserPoints && user.points !== undefined) {
                mobileUserPoints.innerHTML = `<i class="fas fa-star mr-1"></i>${user.points.toLocaleString()} pts`;
            }
        });

        // Logout function
        // Logout function
async function logout() {
    if (!confirm('Are you sure you want to logout?')) return;

    try {
        const response = await fetch('../backend/logout.php', {
            method: 'POST',
            credentials: 'include'
        });

        const result = await response.json();

        if (result.success) {
            window.location.href = '../pages/login.php';
        } else {
            alert('Logout failed.');
        }

    } catch (error) {
        console.error('Logout error:', error);
        alert('Something went wrong.');
    }
}

// User dropdown toggle
document.addEventListener('DOMContentLoaded', function () {

    const userMenuButton = document.getElementById('userMenuButton');
    const userDropdown = document.getElementById('userDropdown');

    if (!userMenuButton || !userDropdown) return;

    userMenuButton.addEventListener('click', function (e) {
        e.stopPropagation();
        userDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function (e) {
        if (!userMenuButton.contains(e.target) &&
            !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });
});

        
    </script>
</body>

</html>