CREATE PROCEDURE `FindMin`() NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN SELECT nume FROM clienti NATURAL JOIN Bilete WHERE clasa='Business' AND valoare<=ALL(SELECT valoare FROM bilete WHERE clasa='Business'); END