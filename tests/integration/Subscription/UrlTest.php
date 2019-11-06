<?php

namespace MailPoet\Test\Subscription;

use Codeception\Util\Stub;
use MailPoet\Config\Populator;
use MailPoet\Features\FeaturesController;
use MailPoet\Models\Subscriber;
use MailPoet\Referrals\ReferralDetector;
use MailPoet\Router\Router;
use MailPoet\Settings\SettingsController;
use MailPoet\Settings\SettingsRepository;
use MailPoet\Subscribers\LinkTokens;
use MailPoet\Subscription\Captcha;
use MailPoet\Subscription\SubscriptionUrlFactory;
use MailPoet\WP\Functions as WPFunctions;

class UrlTest extends \MailPoetTest {

  /** @var SubscriptionUrlFactory */
  private $url;

  /** @var SettingsController */
  private $settings;

  function _before() {
    parent::_before();
    $this->settings = SettingsController::getInstance();
    $referral_detector = new ReferralDetector(WPFunctions::get(), $this->settings);
    $features_controller = Stub::makeEmpty(FeaturesController::class);
    $populator = new Populator($this->settings, WPFunctions::get(), new Captcha, $referral_detector, $features_controller);
    $populator->up();
    $this->url = new SubscriptionUrlFactory(WPFunctions::get(), $this->settings, new LinkTokens);
  }

  function testItReturnsTheDefaultPageUrlIfNoPageIsSetInSettings() {
    $this->settings->delete('subscription');

    $url = $this->url->getCaptchaUrl('abc');
    expect($url)->notNull();
    expect($url)->contains('action=captcha');
    expect($url)->contains('endpoint=subscription');

    $url = $this->url->getUnsubscribeUrl(null);
    expect($url)->notNull();
    expect($url)->contains('action=unsubscribe');
    expect($url)->contains('endpoint=subscription');
  }

  function testItReturnsTheCaptchaUrl() {
    $url = $this->url->getCaptchaUrl('abc');
    expect($url)->notNull();
    expect($url)->contains('action=captcha');
    expect($url)->contains('endpoint=subscription');
  }

  function testItReturnsTheCaptchaImageUrl() {
    $url = $this->url->getCaptchaImageUrl(250, 100, 'abc');
    expect($url)->notNull();
    expect($url)->contains('action=captchaImage');
    expect($url)->contains('endpoint=subscription');
  }

  function testItReturnsTheConfirmationUrl() {
    // preview
    $url = $this->url->getConfirmationUrl(null);
    expect($url)->notNull();
    expect($url)->contains('action=confirm');
    expect($url)->contains('endpoint=subscription');

    // actual subscriber
    $subscriber = Subscriber::createOrUpdate([
      'email' => 'john@mailpoet.com',
    ]);
    $url = $this->url->getConfirmationUrl($subscriber);
    expect($url)->contains('action=confirm');
    expect($url)->contains('endpoint=subscription');

    $this->checkData($url);
  }

  function testItReturnsTheManageSubscriptionUrl() {
    // preview
    $url = $this->url->getManageUrl(null);
    expect($url)->notNull();
    expect($url)->contains('action=manage');
    expect($url)->contains('endpoint=subscription');

    // actual subscriber
    $subscriber = Subscriber::createOrUpdate([
      'email' => 'john@mailpoet.com',
    ]);
    $url = $this->url->getManageUrl($subscriber);
    expect($url)->contains('action=manage');
    expect($url)->contains('endpoint=subscription');

    $this->checkData($url);
  }

  function testItReturnsTheUnsubscribeUrl() {
    // preview
    $url = $this->url->getUnsubscribeUrl(null);
    expect($url)->notNull();
    expect($url)->contains('action=unsubscribe');
    expect($url)->contains('endpoint=subscription');

    // actual subscriber
    $subscriber = Subscriber::createOrUpdate([
      'email' => 'john@mailpoet.com',
    ]);
    $url = $this->url->getUnsubscribeUrl($subscriber);
    expect($url)->contains('action=unsubscribe');
    expect($url)->contains('endpoint=subscription');

    $this->checkData($url);
  }

  private function checkData($url) {
    // extract & decode data from url
    $url_params = parse_url($url);
    parse_str($url_params['query'], $params);
    $data = Router::decodeRequestData($params['data']);

    expect($data['email'])->contains('john@mailpoet.com');
    expect($data['token'])->notEmpty();
  }

  function _after() {
    $this->di_container->get(SettingsRepository::class)->truncate();
    Subscriber::deleteMany();
  }
}
