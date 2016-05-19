define([
  'react',
  'moment',
], function(
  React,
  Moment
) {
  class FormFieldDateYear extends React.Component {
    render() {
      const yearsRange = 100;
      const years = [];

      if (this.props.placeholder !== undefined) {
        years.push((
          <option value="" key={ 0 }>{ this.props.placeholder }</option>
        ));
      }

      const currentYear = Moment().year();
      for (let i = currentYear; i >= currentYear - yearsRange; i--) {
        years.push((
          <option
            key={ i }
            value={ i }
         >{ i }</option>
        ));
      }
      return (
        <select
          name={ this.props.name + '[year]' }
          value={ this.props.year }
          onChange={ this.props.onValueChange }
        >
          { years }
        </select>
      );
    }
  }

  class FormFieldDateMonth extends React.Component {
    render() {
      const months = [];

      if (this.props.placeholder !== undefined) {
        months.push((
          <option value="" key={ 0 }>{ this.props.placeholder }</option>
        ));
      }

      for (let i = 1; i <= 12; i++) {
        months.push((
          <option
            key={ i }
            value={ i }
         >{ this.props.monthNames[i - 1] }</option>
        ));
      }
      return (
        <select
          name={ this.props.name + '[month]' }
          value={ this.props.month }
          onChange={ this.props.onValueChange }
        >
          { months }
        </select>
      );
    }
  }

  class FormFieldDateDay extends React.Component {
    render() {
      const days = [];

      if (this.props.placeholder !== undefined) {
        days.push((
          <option value="" key={ 0 }>{ this.props.placeholder }</option>
        ));
      }

      for (let i = 1; i <= 31; i++) {
        days.push((
          <option
            key={ i }
            value={ i }
          >{ i }</option>
        ));
      }

      return (
        <select
          name={ this.props.name + '[day]' }
          value={ this.props.day }
          onChange={ this.props.onValueChange }
        >
          { days }
        </select>
      );
    }
  }

  class FormFieldDate extends React.Component {
    constructor(props) {
      super(props);
      this.state = {
        year: undefined,
        month: undefined,
        day: undefined
      }
    }
    componentDidMount() {
    }
    componentDidUpdate(prevProps, prevState) {
      if (
        (this.props.item !== undefined && prevProps.item !== undefined)
        && (this.props.item.id !== prevProps.item.id)
      ) {
        this.extractTimeStamp();
      }
    }
    extractTimeStamp() {
      const timeStamp = parseInt(this.props.item[this.props.field.name], 10);
      this.setState({
        year: Moment.unix(timeStamp).year(),
        // Moment returns the month as [0..11]
        // We increment it to match PHP's mktime() which expects [1..12]
        month: Moment.unix(timeStamp).month() + 1,
        day: Moment.unix(timeStamp).date()
      });
    }
    updateTimeStamp(field) {
      let newTimeStamp = Moment(
        `${this.state.month}/${this.state.day}/${this.state.year}`,
        'M/D/YYYY'
      ).valueOf();
      if (~~(newTimeStamp) > 0) {
        // convert milliseconds to seconds
        newTimeStamp /= 1000;
        return this.props.onValueChange({
          target: {
            name: field,
            value: newTimeStamp
          }
        });
      }
    }
    onValueChange(e) {
      // extract property from name
      const matches = e.target.name.match(/(.*?)\[(.*?)\]/);
      let field = null;
      let property = null;

      if (matches !== null && matches.length === 3) {
        field = matches[1];
        property = matches[2];

        let value = parseInt(e.target.value, 10);

        this.setState({
          [`${property}`]: value
        }, () => {
          this.updateTimeStamp(field);
        });
      }
    }
    render() {
      const monthNames = window.mailpoet_month_names || [];

      const dateType = this.props.field.params.date_type;

      const dateSelects = dateType.split('_');

      const fields = dateSelects.map(type => {
        switch(type) {
          case 'year':
            return (<FormFieldDateYear
              onValueChange={ this.onValueChange.bind(this) }
              ref={ 'year' }
              key={ 'year' }
              name={ this.props.field.name }
              year={ this.state.year }
              placeholder={ this.props.field.year_placeholder }
            />);
          break;

          case 'month':
            return (<FormFieldDateMonth
              onValueChange={ this.onValueChange.bind(this) }
              ref={ 'month' }
              key={ 'month' }
              name={ this.props.field.name }
              month={ this.state.month }
              monthNames={ monthNames }
              placeholder={ this.props.field.month_placeholder }
            />);
          break;

          case 'day':
            return (<FormFieldDateDay
              onValueChange={ this.onValueChange.bind(this) }
              ref={ 'day' }
              key={ 'day' }
              name={ this.props.field.name }
              day={ this.state.day }
              placeholder={ this.props.field.day_placeholder }
            />);
          break;
        }
       });

      return (
        <div>
          {fields}
        </div>
      );
    }
  };

  return FormFieldDate;
});