php-selense
===========

Directly run Selenese HTML tests via php-webdriver.

The idea is: toss a Selenese HTML test at this script, kick up a phantomjs instance, extract the test, interpret it, run it, return a run report, and cleanup after itself.

This script relies on two important projects:

 * [PhantomJS](http://phantomjs.org/) Headless webkit browser with Selenium webdriver support
 * [php-webdriver](https://github.com/facebook/php-webdriver) by Facebook

That said, the PhantomJS part is NOT required, I just think it's the fastest way to get the test run, you can very easily, instead, point your webdriver at any other Selenium 2 server of your choice.

Clearly this project is currently in a significantly early stage of life. If you're interested in helping, the most pressing task is going to be the lib/Selenese/Command folder where all Selenese commands need to be created and converted over to webdriver commands.

There's still a bit to do with error handling and lots of other things, like options, and...other stuff, I'm sure :)

---

There are some other options out there too, if you are curious:

 * [PySelenese](https://github.com/jpstacey/PySelenese) - Pretty sure this was based on Selenium1, so not very useful now.
 * [Selenese Runner](https://github.com/DBCDK/selenese-runner) - NodeJS variant, but couldn't quite get it to work, also suspect Selenium1 nature.
 * [Selenese Runner Java](https://github.com/vmi/selenese-runner-java) - Works, Selenium2 compatible, but tons of fun to compile and, well, java incurs a good amount of startup/teardown time.