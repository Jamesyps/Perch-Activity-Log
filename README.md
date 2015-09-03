# Jekyll-Project-Page
A Jekyll template for individual projects using Github Pages.

[View Demo](http://jamesyps.github.io/Jekyll-Project-Page/)

### Create the pages branch
Github has a [guide here](https://help.github.com/articles/creating-project-pages-manually/) for manually setting up a new project page.

### Install
Clone or download the .zip of this repository and copy the files onto your pages branch. To preview the page before
pushing it live, run `bundle install` and when this is complete `jekyll serve --watch` from your pages folder. 
You can now visit http://localhost:4000 to view the page.

### Customising
To change the colourscheme and font stack, open `css/main.scss` in your editor and configure the variables defined there:

    $primary-colour: #36C7C2 !default;
    $primary-colour-dark: #0094A5 !default;
    
    $secondary-colour: #631A44 !default;
    $secondary-colour-dark: #441D4B !default;
    
    $body-colour: #FAFAFA !default;
    $copy-colour: #30485F !default;
    $header-colour: $primary-colour-dark !default;
    
    $font-stack: 'Lato', sans-serif !default;