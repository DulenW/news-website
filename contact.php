<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Contact Us</title>
</head>
<body>
    <header class="dashboard-header">
        <h1>Contact Us</h1>
        <a href="index.php" class="logout-btn">Back to Home</a>
    </header>
    <main class="dashboard-container">
        <section class="add-news">
            <h2>Contact Us</h2>
            <form action="php/contact_form.php" method="POST" class="news-form">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Write your message" required></textarea>
                
                <button type="submit" class="btn">Send Message</button>
            </form>
        </section>
    </main>
</body>
</html>

