--INSERT INTO
--	PUBLIC.ASSESSMENTS (
--		NAME,
--		TYPE,
--		DESCRIPTION,
--		TIME,
--		QUESTION_COUNT,
--		DIFFICULTY,
--		SUBJECT,
--		CREATOR_ID
--	)
--VALUES
--	(
--		'test_quiz_1',
--		'QUIZ',
--		'test_description_1',
--		9999,
--		30,
--		'EASY',
--		'MATH',
--		1
--	);

--SELECT * from public.users;
--SELECT * from public.assessments;

INSERT INTO public.users(username, password, is_admin) VALUES('user_test_3', 'user_pass_3', false);
-- INSERT INTO public.sessions(started_at, ended_at, correct_questions,
-- 	assessment_id, user_id)

-- VALUES(CURRENT_TIMESTAMP, '2024-07-07 22:49:11.718238', 30, 3, 1)

