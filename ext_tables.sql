# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chfbase_domain_model_relation_bibliographic_entry_bibentry_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbib_domain_model_bibliographic_entry_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL,
	tablenames varchar(63) DEFAULT '' NOT NULL
);
