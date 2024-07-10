-- Drop existing tables if they exist (for idempotency)
DROP TABLE IF EXISTS public."sessions";
DROP TABLE IF EXISTS public."assessments";
DROP TABLE IF EXISTS public."users";
DROP TYPE IF EXISTS AssessmentType;
DROP TYPE IF EXISTS AssessmentDifficulty;
DROP TYPE IF EXISTS AssessmentSubject;

-- Create ENUM types
CREATE TYPE AssessmentType AS ENUM ('QUIZ', 'TEST', 'EXAM');
CREATE TYPE AssessmentDifficulty AS ENUM ('EASY', 'MODERATE', 'HARD');
CREATE TYPE AssessmentSubject AS ENUM ('MATH', 'GEOGRAPHY', 'BIOLOGY', 'SCIENCE');

-- Create User table
CREATE TABLE public."users" (
    id SERIAL PRIMARY KEY,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(102) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE;
);

-- Create Assessment table
CREATE TABLE public."assessments" (
    id SERIAL PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    type AssessmentType NOT NULL,
    description VARCHAR(200),
    time INTEGER CHECK (time > 0 AND time <= 99999),
    question_count INTEGER CHECK (question_count > 0 AND question_count <= 99999),
    difficulty AssessmentDifficulty,
    subject AssessmentSubject,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creator_id INTEGER NOT NULL,
    CONSTRAINT fk_creator FOREIGN KEY (creator_id) REFERENCES public."users"(id)
);

-- Create Session table
CREATE TABLE public."sessions" (
    id SERIAL PRIMARY KEY,
    started_at TIMESTAMP NOT NULL,
    ended_at TIMESTAMP NOT NULL CURRENT_TIMESTAMP,
    correct_questions INTEGER CHECK (correct_questions >= 0),
    assessment_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    CONSTRAINT fk_assessment FOREIGN KEY (assessment_id) REFERENCES public."assessments"(id),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES public."users"(id)
);

-- Triggers to handle automatic timestamp updates
CREATE OR REPLACE FUNCTION set_created_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.created_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION set_updated_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION set_started_at()
RETURNS TRIGGER AS $$
BEGIN
    NEW.started_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION set_ended_at()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.ended_at IS NULL THEN
        NEW.ended_at = NEW.started_at + INTERVAL '1 second' * (SELECT time FROM public."assessments" WHERE id = NEW.assessment_id);
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_set_created_at
BEFORE INSERT ON public."assessments"
FOR EACH ROW
EXECUTE FUNCTION set_created_at();

CREATE TRIGGER trg_set_updated_at
BEFORE UPDATE ON public."assessments"
FOR EACH ROW
EXECUTE FUNCTION set_updated_at();

CREATE TRIGGER trg_set_started_at
BEFORE INSERT ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION set_started_at();

CREATE TRIGGER trg_set_ended_at
BEFORE INSERT OR UPDATE ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION set_ended_at();

-- Function to ensure correct_questions <= question_count
CREATE OR REPLACE FUNCTION check_correct_questions()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.correct_questions > (SELECT question_count FROM public."assessments" WHERE id = NEW.assessment_id) THEN
        RAISE EXCEPTION 'correct_questions cannot be greater than assessment.question_count';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_check_correct_questions
BEFORE INSERT OR UPDATE ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION check_correct_questions();

-- Function to ensure started_at >= created_at
CREATE OR REPLACE FUNCTION check_started_at()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.started_at < (SELECT created_at FROM public."assessments" WHERE id = NEW.assessment_id) THEN
        RAISE EXCEPTION 'started_at cannot be earlier than assessment.created_at';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_check_started_at
BEFORE INSERT OR UPDATE ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION check_started_at();

-- Function to ensure ended_at >= started_at and within time interval
CREATE OR REPLACE FUNCTION check_ended_at()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.ended_at IS NOT NULL THEN
        IF NEW.ended_at < NEW.started_at OR
           NEW.ended_at > NEW.started_at + INTERVAL '1 second' * (SELECT time FROM public."assessments" WHERE id = NEW.assessment_id) THEN
            RAISE EXCEPTION 'ended_at must be within the correct time interval';
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_check_ended_at
BEFORE INSERT OR UPDATE ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION check_ended_at();

-- Ensure assessment_id and user_id are valid using triggers
CREATE OR REPLACE FUNCTION check_assessment_id_valid()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM public."assessments" WHERE id = NEW.assessment_id) THEN
        RAISE EXCEPTION 'assessment_id is not valid';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_check_assessment_id_valid
BEFORE INSERT OR UPDATE ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION check_assessment_id_valid();

CREATE OR REPLACE FUNCTION check_user_id_valid()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM public."users" WHERE id = NEW.user_id) THEN
        RAISE EXCEPTION 'user_id is not valid';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_check_user_id_valid
BEFORE INSERT OR UPDATE ON public."sessions"
FOR EACH ROW
EXECUTE FUNCTION check_user_id_valid();

-- Ensure creator_id is valid in Assessment
CREATE OR REPLACE FUNCTION check_creator_id_valid()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM public."users" WHERE id = NEW.creator_id) THEN
        RAISE EXCEPTION 'creator_id is not valid';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_check_creator_id_valid
BEFORE INSERT OR UPDATE ON public."assessments"
FOR EACH ROW
EXECUTE FUNCTION check_creator_id_valid();