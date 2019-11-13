const dotenv = require('dotenv').config();
const Twitter = require('twitter-node-client').Twitter;

const twitter = new Twitter({
    consumerKey: process.env.twitterConsumerKey,
    consumerSecret: process.env.twitterConsumerSecret,
    accessToken: process.env.twitterAccessToken,
    accessTokenSecret: process.env.twitterAccessTokenSecret,
    callBackUrl: process.env.twitterCallBackUrl,
});

const _f = function () { };

const error = function (err, res, json) {
    console.log('ERROR', err, JSON.parse(json));
};

const success = function (json) {
    Array.from(JSON.parse(json)).forEach(onMention);
}



function onMention(tweet) {
    if (!tweet.retweeted) {
        twitter.doPost("https://api.twitter.com/1.1/statuses/retweet/" + tweet.id_str + ".json", {}, _f, _f);
    }
}

function main() {
    twitter.getMentionsTimeline({ count: '200' }, error, success);
    console.log("\n" + new Date().toLocaleString("en-US", {timeZone: "America/Chicago"}));
}

main()
setInterval(main, 1000 * 60 * 2) // every two minutes.