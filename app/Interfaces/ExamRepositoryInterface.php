<?php

namespace App\Repositories\Interfaces;

interface ExamRepositoryInterface
{
    public function findByToken(string $token);
    public function updateStatus(int $examId, string $status): bool;
    // public function evaluateExam(int $examId): bool;
    // public function calculateScore(int $examId): array;
    // public function isExamPassed(int $examId): bool;
    // public function getExamWithResponses(int $examId);
}