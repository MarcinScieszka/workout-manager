INSERT INTO public.status (id, status) VALUES (1, 'active');
INSERT INTO public.status (id, status) VALUES (2, 'completed');
INSERT INTO public.status (id, status) VALUES (3, 'cancelled');

INSERT INTO public.exercise_type (id, exercise_type) VALUES (1, 'back');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (2, 'chest');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (3, 'legs');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (4, 'abs');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (5, 'triceps');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (6, 'biceps');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (7, 'arms');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (8, 'other');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (9, 'shoulders');
INSERT INTO public.exercise_type (id, exercise_type) VALUES (10, 'grip');

INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (19, 'Incline barbell bench press', 2);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (2, 'Barbell back squat', 3);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (3, 'Barbell front squat', 3);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (1, 'Romanian deadlift', 1);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (14, 'Dip', 5);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (28, 'Bent over row', 1);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (29, 'Single-arm row', 1);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (30, 'Chin-up', 1);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (31, 'Pull-up', 1);
INSERT INTO public.exercise (id, exercise_name, id_exercise_type) VALUES (25, 'Standard deadlift', 1);

INSERT INTO public.workout_difficulty (id, difficulty) VALUES (1, 'Just a training');
INSERT INTO public.workout_difficulty (id, difficulty) VALUES (2, 'Hard work');
INSERT INTO public.workout_difficulty (id, difficulty) VALUES (3, 'Blood, sweat and tears');
INSERT INTO public.workout_difficulty (id, difficulty) VALUES (4, 'Death march');

INSERT INTO public.workout_type (id, type) VALUES (1, 'Bodybuilding');
INSERT INTO public.workout_type (id, type) VALUES (2, 'Powerlifting');
INSERT INTO public.workout_type (id, type) VALUES (3, 'Armwrestling');

INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (131, 26);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (131, 18);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (134, 26);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (134, 32);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (134, 16);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (134, 14);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (135, 18);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (135, 21);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (135, 2);
INSERT INTO public.workout_exercise (id_workout, id_exercise) VALUES (136, 23);

INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (131, 'Polis Mow s Workout', 3, 1, 1);
INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (134, 'Jon Ricor Hammer Workout', 2, 4, 6);
INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (135, 'Gibb Ter Workout', 1, 1, 1);
INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (136, 'Tom Rakes Upper Body Workout', 2, 4, 1);
INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (137, 'Adam Pol FBW', 2, 3, 1);
INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (139, 'Simons Lee Hook Workout', 3, 2, 1);
INSERT INTO public.workout (id, workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (141, 'Rob Hos Pull Workout', 2, 2, 6);

INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (8, 26, 2, 5, 131, 'des1');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (9, 18, 2, 4, 131, 'des21');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (12, 26, 3, 4, 134, 'Tempo: 3010');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (14, 16, 3, 1, 134, 'Hold 60sek');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (15, 14, 3, 20, 134, 'Max reps');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (13, 32, 3, 6, 134, 'RPE8');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (16, 18, 3, 6, 135, 'RPE7');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (17, 21, 3, 5, 135, '45% inclination');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (18, 2, 4, 5, 135, '1s pause');
INSERT INTO public.workout_exercise_details (id, id_exercise, sets, reps, id_workout, details) VALUES (19, 23, 4, 12, 136, '3s down');

INSERT INTO public.workout_assignment (id, id_workout, id_user, workout_date, id_status) VALUES (6, 131, 1, '2022-02-15 11:51:00.000000', 2);
INSERT INTO public.workout_assignment (id, id_workout, id_user, workout_date, id_status) VALUES (10, 134, 6, '2022-02-07 12:52:00.000000', 3);
INSERT INTO public.workout_assignment (id, id_workout, id_user, workout_date, id_status) VALUES (11, 137, 10, '2022-02-08 07:30:00.000000', 1);
