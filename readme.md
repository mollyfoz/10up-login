# 10up Login Plugin for WordPress

This is a custom plugin for WordPress that replaces the default WordPress login form. Languages used include: PHP, CSS, and Javascript.

#### Process

This is my first experience with WordPress, so initially I tried to do as much research as possible to understand the context within which I would be working. Research included how to spin up a WordPress environment, how to create a plugin from scratch, and tried to get a high level understanding of PHP, actions, and hooks.

The next step in my process involved going through a few tutorials and doing a couple of dry runs to get my plugin to show up on the WordPress dashboard. After a couple of successful tries, I created my final environment using Local by Flywheel and the 10up plugin scaffold.

#### Design Decisions

Overall design was based off of the 10up website.
* The page background is an abstract image with a solid color overlay.
* The login form color scheme is based on the contact form on the 10up website.
* Consistent color scheme.
* Used a combination of italic serif and normal sans serif fonts.

Some granular decisions were based on mobile screen size such as making the submit buttons full width. Additionally, UX decisions were made such as adding a red border to an input field that needs to be completed.

#### Specific Considerations

Certain items, such as the default WordPress form, I chose to mark as `display: none;` with CSS. I want to acknowledge that I made this decision due to my limited understanding of WordPress. I opted to timebox the struggles that I had with overriding default Wordpress for the sake of progress on this project.

I tried to make the CSS as modular as possible by splitting sections into components. Due to this decision, there are cases where there is some duplication with styles. In the future I would like to research more on how to make the styles as DRY as possible, and which approach is considered best practice.

#### Javascript Decisions

Due to the sheer amount of built in functionality in WordPress, I felt it to be most pragmatic in this case to keep the additional functionality with Javascript on the lighter side to avoid potentially clashing with functionality that I wasn't aware of.

The `form.js` file checks to see if the form fields are completed before submitting if the user clicks the box to submit. If the input fields are not completed, the `error` class is added to the element and a red border is added to the input field on the form. When the user types inside of the box, the `error` class is removed and the user is able to submit when all required fields are filled in. This is present on both the standard username and password form and the lost password form.

#### Screenshots

![Login Form](https://github.com/mollyfoz/10up-login/blob/master/assets/images/screen-shots/login-form.png)
![Red Border on Input](https://github.com/mollyfoz/10up-login/blob/master/assets/images/screen-shots/red-border.png)
![Button Hover](https://github.com/mollyfoz/10up-login/blob/master/assets/images/screen-shots/button-hover.png)
![Lost Password Form](https://github.com/mollyfoz/10up-login/blob/master/assets/images/screen-shots/lost-password-form.png)

Molly Magnifico, June 2018
