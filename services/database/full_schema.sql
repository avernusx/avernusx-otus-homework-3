CREATE EXTENSION if not exists pgcrypto;
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

CREATE TABLE "users" (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    login VARCHAR(256) NOT NULL UNIQUE,
    password VARCHAR(512) NOT NULL,
    email VARCHAR(256) UNIQUE
);