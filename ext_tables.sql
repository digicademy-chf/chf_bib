# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfbib_domain_model_bibliographic_entry (
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chfbase_domain_model_relation (
    elaboration varchar(255) DEFAULT '' NOT NULL
);
