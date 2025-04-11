<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? htmlspecialchars($_SESSION['full_name']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BudgetWise - Smart Financial Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-2xl font-bold text-gray-800">BudgetWise</span>
                </div>
                <div class="flex items-center space-x-6">
                    <?php if ($isLoggedIn): ?>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Welcome, <span class="font-medium"><?php echo $userName; ?></span></span>
                        <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors transform hover:scale-105 duration-200 shadow-md">
                            Logout
                        </a>
                    </div>
                    <?php else: ?>
                    <a href="login.html" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Login</a>
                    <a href="register.html" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors transform hover:scale-105 duration-200 shadow-md">
                        Get Started
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-24 bg-gradient-to-br from-blue-50 to-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="lg:w-1/2 space-y-8">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Smart Budget Management Made <span class="text-blue-600">Simple</span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Take control of your finances with our intuitive budget tracking tools. Plan, save, and achieve your financial goals.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <?php if ($isLoggedIn): ?>
                        <a href="dashboard.php" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition transform hover:scale-105 duration-200 shadow-lg text-center">
                            Go to Dashboard
                        </a>
                        <?php else: ?>
                        <a href="register.html" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition transform hover:scale-105 duration-200 shadow-lg text-center">
                            Start Tracking
                        </a>
                        <?php endif; ?>
                        <a href="blog.html" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition border-2 border-blue-600 transform hover:scale-105 duration-200 shadow-lg text-center">
                            Finance Blogs & Videos
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <img src="https://placehold.co/600x400/e2e8f0/475569" alt="Budget Management" class="rounded-2xl shadow-2xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16">Why Choose BudgetWise?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div class="p-8 rounded-xl bg-white shadow-lg hover:shadow-xl transition duration-300 border border-gray-100">
                    <div class="text-4xl font-bold text-blue-600 mb-4">100%</div>
                    <h3 class="text-xl font-semibold mb-4">Free</h3>
                    <p class="text-gray-600">Start managing your budget without any cost</p>
                </div>
                <div class="p-8 rounded-xl bg-white shadow-lg hover:shadow-xl transition duration-300 border border-gray-100">
                    <div class="text-4xl font-bold text-blue-600 mb-4">256-bit</div>
                    <h3 class="text-xl font-semibold mb-4">Secure</h3>
                    <p class="text-gray-600">Bank-level security for your data</p>
                </div>
                <div class="p-8 rounded-xl bg-white shadow-lg hover:shadow-xl transition duration-300 border border-gray-100">
                    <div class="text-4xl font-bold text-blue-600 mb-4">24/7</div>
                    <h3 class="text-xl font-semibold mb-4">Available</h3>
                    <p class="text-gray-600">Access your budget anytime, anywhere</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-tr from-blue-50 to-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">Ready to Take Control of Your Finances?</h2>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <?php if ($isLoggedIn): ?>
                <a href="dashboard.php" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition transform hover:scale-105 duration-200 shadow-lg inline-block">
                    Go to Dashboard
                </a>
                <?php else: ?>
                <a href="register.html" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition transform hover:scale-105 duration-200 shadow-lg inline-block">
                    Start Tracking
                </a>
                <?php endif; ?>
                <a href="blog.html" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition border-2 border-blue-600 transform hover:scale-105 duration-200 shadow-lg inline-block">
                    Finance Blogs & Videos
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <div class="flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="ml-2 text-xl font-bold">BudgetWise</span>
                </div>
                <p class="text-gray-400">&copy; 2025 BudgetWise. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
