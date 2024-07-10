
-- DDL modification 1 (09.07.2024, 18:55)
-- Alter the started_at column to be NOT NULL
ALTER TABLE public.sessions
ALTER COLUMN started_at SET NOT NULL;

-- Alter the ended_at column to have a default value of CURRENT_TIMESTAMP
ALTER TABLE public.sessions
ALTER COLUMN ended_at SET DEFAULT CURRENT_TIMESTAMP;