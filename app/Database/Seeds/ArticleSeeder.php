<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // Articles data
        $articles = [
            [
                'title' => 'Getting Started with CodeIgniter 4',
                'content' => '<p>CodeIgniter is a powerful PHP framework with a very small footprint, built for developers who need a simple and elegant toolkit to create full-featured web applications.</p>
                <h3>Key Features</h3>
                <ul>
                    <li>MVC Architecture</li>
                    <li>Lightweight and Fast</li>
                    <li>Excellent Documentation</li>
                    <li>Active Community</li>
                </ul>
                <p>CodeIgniter 4 is the latest version which brings many improvements and new features to make development even more enjoyable and productive.</p>
                <h3>Installation</h3>
                <p>You can install CodeIgniter 4 using Composer:</p>
                <pre><code>composer create-project codeigniter4/appstarter project-name</code></pre>
                <p>This will create a new CodeIgniter 4 project in the "project-name" directory.</p>',
                'featured_image' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Mastering CSS Grid Layout',
                'content' => '<p>CSS Grid Layout is a two-dimensional layout system designed specifically for the web. It allows you to organize content in rows and columns, and has many features that make building complex layouts straightforward.</p>
                <h3>Basic Grid Layout</h3>
                <p>To create a basic grid layout, you need to define a container element with <code>display: grid</code> and set the column and row sizes with <code>grid-template-columns</code> and <code>grid-template-rows</code>.</p>
                <pre><code>.container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-gap: 20px;
}</code></pre>
                <p>This creates a three-column grid with equal-width columns and a 20px gap between grid items.</p>
                <h3>Advanced Grid Features</h3>
                <p>CSS Grid also provides powerful features like named grid lines, grid areas, and auto-placement algorithms that make it incredibly versatile for creating complex layouts.</p>',
                'featured_image' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'title' => 'Introduction to Machine Learning',
                'content' => '<p>Machine Learning is a subset of artificial intelligence that provides systems the ability to automatically learn and improve from experience without being explicitly programmed.</p>
                <h3>Types of Machine Learning</h3>
                <ul>
                    <li><strong>Supervised Learning:</strong> The algorithm is trained on labeled data.</li>
                    <li><strong>Unsupervised Learning:</strong> The algorithm finds patterns in unlabeled data.</li>
                    <li><strong>Reinforcement Learning:</strong> The algorithm learns by interacting with an environment.</li>
                </ul>
                <h3>Popular Machine Learning Algorithms</h3>
                <p>Some widely used machine learning algorithms include:</p>
                <ul>
                    <li>Linear Regression</li>
                    <li>Decision Trees</li>
                    <li>Random Forests</li>
                    <li>Support Vector Machines</li>
                    <li>Neural Networks</li>
                </ul>
                <p>Machine learning is being applied across various industries including healthcare, finance, marketing, and more to solve complex problems and make data-driven decisions.</p>',
                'featured_image' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'title' => 'Responsive Web Design Principles',
                'content' => '<p>Responsive Web Design (RWD) is an approach to web design that makes web pages render well on a variety of devices and window or screen sizes.</p>
                <h3>Key Principles</h3>
                <ol>
                    <li><strong>Fluid Grids:</strong> Using relative units like percentages instead of fixed units like pixels for layout elements.</li>
                    <li><strong>Flexible Images:</strong> Sizing images in relative units to prevent them from displaying outside their containing element.</li>
                    <li><strong>Media Queries:</strong> Using CSS media queries to apply different styles for different devices/screen sizes.</li>
                </ol>
                <h3>Example Media Query</h3>
                <pre><code>/* For screens smaller than 768px */
@media (max-width: 768px) {
  .container {
    flex-direction: column;
  }
  .sidebar {
    width: 100%;
  }
}</code></pre>
                <p>By following these principles, you can create websites that provide an optimal viewing and interaction experience across a wide range of devices.</p>',
                'featured_image' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'title' => 'Introduction to Docker for Developers',
                'content' => '<p>Docker is a platform for developing, shipping, and running applications in containers. Containers are lightweight, portable, and self-sufficient environments that can run applications consistently across different computing environments.</p>
                <h3>Key Docker Concepts</h3>
                <ul>
                    <li><strong>Containers:</strong> Isolated environments that package application code and dependencies.</li>
                    <li><strong>Images:</strong> Read-only templates used to create containers.</li>
                    <li><strong>Dockerfile:</strong> A text file that contains instructions for building a Docker image.</li>
                    <li><strong>Docker Compose:</strong> A tool for defining and running multi-container applications.</li>
                </ul>
                <h3>Basic Docker Commands</h3>
                <pre><code># Build an image from a Dockerfile
docker build -t myapp .

# Run a container from an image
docker run -p 8080:80 myapp

# View running containers
docker ps

# Stop a container
docker stop container_id</code></pre>
                <p>Docker has revolutionized software development by addressing the "it works on my machine" problem and enabling consistent development, testing, and production environments.</p>',
                'featured_image' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'title' => 'Digital Marketing Strategies for 2023',
                'content' => '<p>Digital marketing continues to evolve rapidly, and staying ahead of trends is crucial for businesses looking to maintain a competitive edge.</p>
                <h3>Top Digital Marketing Strategies</h3>
                <ol>
                    <li><strong>Content Marketing:</strong> Creating valuable, relevant content to attract and engage a clearly defined audience.</li>
                    <li><strong>SEO Optimization:</strong> Improving website visibility in search engine results pages through technical and content improvements.</li>
                    <li><strong>Social Media Marketing:</strong> Using social platforms to connect with audiences and build brand awareness.</li>
                    <li><strong>Email Marketing:</strong> Sending targeted messages to nurture leads and maintain customer relationships.</li>
                    <li><strong>Video Marketing:</strong> Utilizing video content across platforms to increase engagement and conversions.</li>
                </ol>
                <h3>Emerging Trends</h3>
                <ul>
                    <li>AI-powered marketing automation</li>
                    <li>Voice search optimization</li>
                    <li>Interactive content experiences</li>
                    <li>Augmented reality marketing</li>
                </ul>
                <p>By implementing a mix of these strategies tailored to your business goals and target audience, you can create a comprehensive digital marketing approach that drives results in 2023 and beyond.</p>',
                'featured_image' => null,
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
        ];

        // Insert articles
        $this->db->table('articles')->insertBatch($articles);

        // Article-Category relationships
        // The mappings are based on the article index (starting from 1) and category IDs
        $articleCategories = [
            // Article 1 (CodeIgniter) belongs to: Programming, Web Development
            ['article_id' => 1, 'category_id' => 2], // Programming
            ['article_id' => 1, 'category_id' => 3], // Web Development
            
            // Article 2 (CSS Grid) belongs to: Web Development, Design
            ['article_id' => 2, 'category_id' => 3], // Web Development
            ['article_id' => 2, 'category_id' => 5], // Design
            
            // Article 3 (Machine Learning) belongs to: Technology, Data Science
            ['article_id' => 3, 'category_id' => 1], // Technology
            ['article_id' => 3, 'category_id' => 4], // Data Science
            
            // Article 4 (Responsive Web Design) belongs to: Web Development, Design
            ['article_id' => 4, 'category_id' => 3], // Web Development
            ['article_id' => 4, 'category_id' => 5], // Design
            
            // Article 5 (Docker) belongs to: Technology, Programming
            ['article_id' => 5, 'category_id' => 1], // Technology
            ['article_id' => 5, 'category_id' => 2], // Programming
            
            // Article 6 (Digital Marketing) belongs to: Business
            ['article_id' => 6, 'category_id' => 6], // Business
        ];

        // Insert article-category relationships
        $this->db->table('article_category')->insertBatch($articleCategories);
    }
}
