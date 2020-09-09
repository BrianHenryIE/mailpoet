<?php

namespace MailPoet\Form\Templates\Templates;

use MailPoet\Form\Templates\FormTemplate;

class Template1SlideIn extends FormTemplate {
  const ID = 'template_1_slide_in';

  /** @var string */
  protected $assetsDirectory = 'template-1';

  public function getName(): string {
    return 'Template 1 Slide-in';
  }

  public function getBody(): array {
    return [
      [
        'type' => 'image',
        'id' => 'image',
        'params' => [
          'class_name' => '',
          'align' => 'center',
          'url' => $this->getAssetUrl('Oval@3x-2-1024x570.png'),
          'alt' => '',
          'title' => '',
          'caption' => '',
          'link_destination' => 'none',
          'link' => 'http://mailpoet.info/oval3x-2/',
          'href' => '',
          'link_class' => '',
          'rel' => '',
          'link_target' => '',
          'id' => '244',
          'size_slug' => 'large',
          'width' => '',
          'height' => '',
        ],
      ],
      [
        'type' => 'heading',
        'id' => 'heading',
        'params' => [
          'content' => _x('<span style="font-family: BioRhyme" data-font="BioRhyme" class="mailpoet-has-font">Don’t miss these tips!</span>', 'Text in a web form. Keep HTML tags!', 'mailpoet'),
          'level' => '1',
          'align' => 'center',
          'font_size' => '40',
          'text_color' => '#313131',
          'line_height' => '1.2',
          'background_color' => '',
          'anchor' => '',
          'class_name' => '',
        ],
      ],
      [
        'type' => 'text',
        'params' => [
          'label' => _x('Email', 'Form label', 'mailpoet'),
          'class_name' => '',
          'required' => '1',
          'label_within' => '1',
        ],
        'id' => 'email',
        'name' => 'Email',
        'styles' => [
          'full_width' => '1',
          'bold' => '1',
          'background_color' => '#eeeeee',
          'font_color' => '#abb8c3',
          'border_size' => '0',
          'border_radius' => '8',
          'border_color' => '#313131',
        ],
      ],
      [
        'type' => 'submit',
        'params' => [
          'label' => _x('JOIN THE CLUB', 'Form label', 'mailpoet'),
          'class_name' => '',
        ],
        'id' => 'submit',
        'name' => 'Submit',
        'styles' => [
          'full_width' => '1',
          'bold' => '1',
          'background_color' => '#000000',
          'font_size' => '24',
          'font_color' => '#ffd456',
          'border_size' => '0',
          'border_radius' => '8',
          'padding' => '16',
          'font_family' => 'Montserrat',
        ],
      ],
      [
        'type' => 'paragraph',
        'id' => 'paragraph',
        'params' => [
          'content' => _x('<em><em><span style="font-family: Montserrat" data-font="Montserrat" class="mailpoet-has-font">We don’t spam! Read more in our <a href="#">privacy policy</a>.</span></em></em>', 'Text in a web form. Keep HTML tags!', 'mailpoet'),
          'drop_cap' => '0',
          'align' => 'center',
          'font_size' => '13',
          'line_height' => '1.5',
          'text_color' => '',
          'background_color' => '',
          'class_name' => '',
        ],
      ],
    ];
  }

  public function getSettings(): array {
    return [
      'on_success' => 'message',
      'success_message' => '',
      'segments' => [],
      'segments_selected_by' => 'admin',
      'alignment' => 'left',
      'fontColor' => '#313131',
      'form_placement' => [
        'popup' => ['enabled' => ''],
        'below_posts' => ['enabled' => ''],
        'fixed_bar' => ['enabled' => ''],
        'slide_in' => [
          'enabled' => '1',
          'form_delay' => '0',
          'form_position' => 'right',
          'styles' => [
            'width' => [
              'unit' => 'pixel',
              'value' => '360',
            ],
          ],
        ],
        'others' => [],
      ],
      'border_radius' => '16',
      'border_size' => '0',
      'form_padding' => '20',
      'input_padding' => '16',
      'background_image_display' => 'scale',
      'fontSize' => '20',
      'font_family' => 'Montserrat',
      'success_validation_color' => '#00d084',
      'error_validation_color' => '#cf2e2e',
      'backgroundColor' => '#ffffff',
      'background_image_url' => '',
      'close_button' => 'round_black',
      'form_placement_bellow_posts_enabled' => '',
      'form_placement_popup_enabled' => '',
      'form_placement_fixed_bar_enabled' => '',
      'form_placement_slide_in_enabled' => '1',
    ];
  }

  public function getStyles(): string {
    return <<<EOL
/* form */
.mailpoet_form {
}

form {
  margin-bottom: 0;
}

h1.mailpoet-heading {
	margin: 0 0 20px;
}

p.mailpoet_form_paragraph.last {
    margin-bottom: 5px;
}

/* columns */
.mailpoet_column_with_background {
  padding: 10px;
}
/* space between columns */
.mailpoet_form_column:not(:first-child) {
  margin-left: 20px;
}

/* input wrapper (label + input) */
.mailpoet_paragraph {
  line-height:20px;
  margin-bottom: 20px;
}

/* labels */
.mailpoet_segment_label,
.mailpoet_text_label,
.mailpoet_textarea_label,
.mailpoet_select_label,
.mailpoet_radio_label,
.mailpoet_checkbox_label,
.mailpoet_list_label,
.mailpoet_date_label {
  display:block;
  font-weight: normal;
}

/* inputs */
.mailpoet_text,
.mailpoet_textarea,
.mailpoet_select,
.mailpoet_date_month,
.mailpoet_date_day,
.mailpoet_date_year,
.mailpoet_date {
  display:block;
}

.mailpoet_text,
.mailpoet_textarea {
  width: 200px;
}

.mailpoet_checkbox {
}

.mailpoet_submit {
}

.mailpoet_divider {
}

.mailpoet_message {
}

.mailpoet_form_loading {
  width: 30px;
  text-align: center;
  line-height: normal;
}

.mailpoet_form_loading > span {
  width: 5px;
  height: 5px;
  background-color: #5b5b5b;
}
EOL;
  }
}
