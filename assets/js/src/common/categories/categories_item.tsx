import React from 'react';
import classNames from 'classnames';

export type Category = {
  name: string,
  label: string,
  count?: number | string,
  automationId?: string,
};

type Props = Category & {
  onSelect: (name: string) => any,
  active?: boolean,
};

const CategoriesItem = ({
  onSelect,
  name,
  label,
  count,
  automationId,
  active,
}: Props) => {
  const classes = classNames(
    { 'mailpoet-categories-current': !!active }
  );

  return (
    <li key={name}>
      <a
        href="#"
        className={classes}
        onClick={(event) => {
          event.preventDefault();
          onSelect(name);
        }}
        data-automation-id={automationId}
      >
        <span className="mailpoet-categories-title">
          {label}
        </span>
        {count > 0 && (
          <>
            &nbsp;
            <span className="mailpoet-categories-count">
              { parseInt(count.toString(), 10).toLocaleString() }
            </span>
          </>
        )}
      </a>
    </li>
  );
};

export default CategoriesItem;
