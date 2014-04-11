Tweet Fetcher
===
PHP script to be used with Twitter's v1.1 API with OAuth, originally written for use on my own site.

It simply fetches the last tweet (unless configured otherwise) from the specified Twitter account, it requires application keys that are available to generate at [dev.twitter](https://dev.twitter.com/apps).

Configuration is located at the top of `fetch.php`, which also needs to be included into the page your fetching the tweets to (see `index.php`).

Then use `echo fetchTweet(0)`, where `0` is the tweet you'd like to fetch, starting at the newest -  `echo fetchTweet(1)` would fetch the next tweet behind the latest.

Take a look at `index.php` for an example.

Happy tweeting!
