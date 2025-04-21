# -- Add Google-specific columns to the user table
ALTER TABLE auth_users ADD COLUMN google_id VARCHAR(255) NULL;
ALTER TABLE auth_users ADD COLUMN profile_picture VARCHAR(255) NULL;
ALTER TABLE auth_users ADD COLUMN date_created DATETIME NULL;
ALTER TABLE auth_users ADD COLUMN last_login DATETIME NULL;

# -- Create index for faster queries
CREATE INDEX idx_google_id ON auth_users(google_id);
CREATE INDEX idx_email ON auth_users(email);

# -- Add status column
ALTER TABLE `auth_users` ADD `status` INT NULL AFTER `date_created`;