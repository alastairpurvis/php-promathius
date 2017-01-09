Promathius Web Game [![Circle CI](https://circleci.com/gh/Shopify/Timber.svg?style=svg)]
=====================

Promathius is a turn-based strategy game built on PHP and MySQL. It leverages the Smarty Template Framework for separation between the view and the controller, and also includes phpBB2 for its forum.

Styling and customization is left up to you. Some base styles and helpers are included, but there is **no need to remove any code before you start**. Simply download and get designing.

Basic structure
---------------
```
├── data
│   └── includes contains javascript front-end code
│   └── ini contains game configuration
│   └── scripts includes customized events using simplifed class-based language
│   └── styles contains all CSS stylesheets
│   └── templates contains all HTML files
│   └── images
│   └── guide contains lightweight .wik files for help feature
├── forum
│   ├── phpBB2 files
├── game
│   └── all game engine code and logic
│   └── actions
│   └── clanforums
│   └── JS and CSS minifcation and cache
│   └── template cache
│   └── game configuration cache
│   └── shared libraries
├── config.php
│   └── essential database variables
```