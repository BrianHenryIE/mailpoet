import React, { useState } from 'react';
import PropTypes from 'prop-types';
import MailPoet from 'mailpoet';

function LastSentQuestion({ onSubmit }) {
  const [value, setValue] = useState('over2years');

  function handleChange(event) {
    setValue(event.target.value);
  }

  function handleSubmit() {
    if (value === 'over2years' || value === '1to2years') {
      onSubmit('notRecently');
    } else {
      onSubmit('recently');
    }
  }

  return (
    <>
      <h2>{MailPoet.I18n.t('validationStepLastSentHeading')}</h2>
      <select value={value} onChange={handleChange} className="mailpoet_last_sent">
        <option value="over2years">{MailPoet.I18n.t('validationStepLastSentOption1')}</option>
        <option value="1to2years">{MailPoet.I18n.t('validationStepLastSentOption2')}</option>
        <option value="less1year">{MailPoet.I18n.t('validationStepLastSentOption3')}</option>
        <option value="less3months">{MailPoet.I18n.t('validationStepLastSentOption4')}</option>
      </select>
      <button
        type="button"
        className="button button-primary"
        onClick={handleSubmit}
      >
        {MailPoet.I18n.t('validationStepLastSentNext')}
      </button>
    </>
  );
}

LastSentQuestion.propTypes = {
  onSubmit: PropTypes.func.isRequired,
};


export default LastSentQuestion;
