# 🍳 SavoryAI - Intelligent Recipe Recommendation System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Livewire-3.x-blue?style=for-the-badge&logo=livewire" alt="Livewire">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-cyan?style=for-the-badge&logo=tailwindcss" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/OpenAI-GPT--4-green?style=for-the-badge&logo=openai" alt="OpenAI">
  <img src="https://img.shields.io/badge/PHP-8.2+-purple?style=for-the-badge&logo=php" alt="PHP">
</p>

<p align="center">
  <strong>An AI-powered recipe recommendation platform that uses advanced machine learning algorithms to suggest personalized recipes based on available ingredients and user preferences.</strong>
</p>

---

## 🌟 Features

### 🤖 **AI-Powered Intelligence**

-   **Smart Ingredient Recognition**: Upload photos of ingredients and let GPT-4 Vision identify them automatically
-   **Advanced Recipe Matching**: Uses TF-IDF and Cosine Similarity algorithms for precise recipe recommendations
-   **Personalized Suggestions**: AI learns from user preferences and cooking patterns
-   **Dynamic Scoring System**: Combines ingredient matching, recipe complexity, and popularity metrics

### 🔍 **Smart Recipe Discovery**

-   **Ingredient-Based Search**: Find recipes based on what you have in your kitchen
-   **Calorie Categorization**: Filter recipes by calorie ranges (Low: 0-400, Medium: 401-800, High: 801+)
-   **Advanced Filtering**: Sort by rating, popularity, cooking time, and difficulty
-   **Real-time Matching**: See percentage match scores for each recipe based on your ingredients

### 👥 **User Experience**

-   **Interactive Dashboard**: Beautiful, responsive interface with trending recipes and statistics
-   **Recipe Bookmarking**: Save favorite recipes for quick access
-   **User Ratings & Reviews**: Community-driven recipe evaluation system
-   **Social Features**: Follow creators and discover popular recipes
-   **Mobile-Responsive**: Seamless experience across all devices

### 🛡️ **Content Management**

-   **Role-Based Access Control**: Admin, Creator, and User roles with specific permissions
-   **Recipe Moderation**: Admin approval system for quality control
-   **User Management**: Comprehensive user administration tools
-   **Content Analytics**: Track recipe views, ratings, and user engagement

### 📊 **Analytics & Insights**

-   **Trending Recipes**: Weekly and daily trending recipe tracking
-   **User Statistics**: Creator metrics and recipe performance analytics
-   **Ingredient Database**: 500+ recognized ingredients with smart categorization
-   **Performance Metrics**: Recipe views, ratings, and popularity scoring

---

## 🛠️ Technology Stack

### **Backend**

-   **Laravel 11.x** - Modern PHP framework with elegant syntax
-   **Livewire 3.x** - Full-stack framework for dynamic interfaces
-   **MySQL** - Robust relational database management
-   **Spatie Laravel Permission** - Role and permission management

### **Frontend**

-   **TailwindCSS 3.x** - Utility-first CSS framework
-   **Alpine.js** - Lightweight JavaScript framework
-   **Font Awesome** - Comprehensive icon library
-   **Responsive Design** - Mobile-first approach

### **AI & Machine Learning**

-   **OpenAI GPT-4 Vision** - Advanced image recognition for ingredients
-   **TF-IDF Algorithm** - Term frequency-inverse document frequency for content analysis
-   **Cosine Similarity** - Vector space model for recipe matching
-   **Custom Scoring Algorithm** - Multi-factor recipe recommendation system

### **Development Tools**

-   **Vite** - Fast build tool and development server
-   **Composer** - PHP dependency management
-   **NPM** - Node.js package management
-   **Laravel Socialite** - Social authentication integration

---

## 🚀 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   MySQL 8.0+
-   OpenAI API Key

### Step-by-Step Setup

1. **Clone the repository**

```bash
git clone https://github.com/yourusername/savoryai.git
cd savoryai
```

2. Install PHP dependencies

```
composer install
```

3. Install Node.js dependencies

```
npm install
```

4. Environment setup

```
cp .env.example .env
php artisan key:generate
```

5. Configure your .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=savoryai
DB_USERNAME=your_username
DB_PASSWORD=your_password

OPENAI_API_KEY=your_openai_api_key
OPENAI_ORGANIZATION=your_openai_organization_id
```

6. Database setup

```
php artisan migrate
php artisan db:seed
```

7. Build assets

```
npm run build
```

8. Start the development server

```
php artisan serve
```

9. Start the asset watcher (in a new terminal)

```
npm run dev
```

Visit http://localhost:8000 to access the application.

## 📱 Usage

### For Users

1. Register/Login to access personalized features
2. Upload ingredient photos or manually select ingredients
3. Browse AI-recommended recipes based on your ingredients
4. Filter by calories, difficulty, or cooking time
5. Bookmark favorite recipes for easy access
6. Rate and review recipes to help the community

### For Recipe Creators

1. Create detailed recipes with ingredients, instructions, and photos
2. Submit for moderation to ensure quality standards
3. Track recipe performance with built-in analytics
4. Engage with the community through ratings and feedback

### For Administrators

1. Moderate recipe submissions for quality control
2. Manage user accounts and permissions
3. Monitor platform analytics and user engagement
4. Maintain ingredient database and categorizations

## 🧠 AI Algorithm Details

### Ingredient Recognition

-   Uses OpenAI's GPT-4 Vision model to analyze uploaded images
-   Identifies multiple ingredients with confidence scores
-   Automatically maps to internal ingredient database

### Recipe Recommendation Engine

1. TF-IDF Calculation : Analyzes ingredient frequency across recipe database
2. Vector Space Modeling : Creates mathematical representations of recipes and user preferences
3. Cosine Similarity : Measures similarity between user ingredients and recipe ingredients
4. Multi-factor Scoring : Combines similarity, complexity, and popularity metrics
5. Dynamic Thresholding : Adjusts recommendation sensitivity based on ingredient count

### Scoring Formula

```
Final Score = (Similarity × 0.4) + (Complexity × 
0.3) + (Popularity × 0.3)

Where:
- Similarity: Cosine similarity between user and 
recipe ingredient vectors
- Complexity: Recipe complexity factor (fewer 
ingredients = higher score)
- Popularity: Combination of views and ratings
```

## 🤝 Contributing

We welcome contributions to SavoryAI! Here's how you can help:

### Development Setup

1. Fork the repository
2. Create a feature branch ( git checkout -b feature/amazing-feature )
3. Make your changes
4. Run tests ( php artisan test )
5. Commit your changes ( git commit -m 'Add amazing feature' )
6. Push to the branch ( git push origin feature/amazing-feature )
7. Open a Pull Request

### Contribution Guidelines

-   Follow PSR-12 coding standards
-   Write comprehensive tests for new features
-   Update documentation for any API changes
-   Ensure responsive design compatibility
-   Test AI features with various ingredient combinations

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🙏 Acknowledgments

-   OpenAI for providing advanced AI capabilities
-   Laravel Community for the excellent framework and ecosystem
-   Livewire Team for making reactive interfaces simple
-   TailwindCSS for the utility-first CSS framework
-   Spatie for the permission management package

## 📞 Support

If you encounter any issues or have questions:

-   🐛 Bug Reports : [Submit an issue](https://github.com/irfanfaiz25/smart-recipe-recommender/issues/new?template=bug_report.md)

## Contact

For general inquiries, suggestions, or collaborations:

-   📧 Email : [ahmadirfanfaiz13@gmail.com](mailto:ahmadirfanfaiz13@gmail.com)

Made with ❤️ by [Irfan Faiz](https://irfanfaiz.my.id)

<a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" style="position: fixed; bottom: 20px; right: 20px; padding: 10px; background-color: #333; color: white; text-decoration: none; border-radius: 5px;">⬆️ Back to Top</a>
