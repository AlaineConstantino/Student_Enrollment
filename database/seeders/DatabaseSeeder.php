<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'full_name' => 'Admin User',
                'email' => 'admin@brightminds.edu',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create demo parent users
        $parent1 = User::firstOrCreate(
            ['username' => 'alicej'],
            [
                'full_name' => 'Alice Johnson',
                'email' => 'alice@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]
        );

        $parent2 = User::firstOrCreate(
            ['username' => 'bobsmith'],
            [
                'full_name' => 'Bob Smith',
                'email' => 'bob@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]
        );

        $parent3 = User::firstOrCreate(
            ['username' => 'sarahw'],
            [
                'full_name' => 'Sarah Wilson',
                'email' => 'sarah@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]
        );

        $parent4 = User::firstOrCreate(
            ['username' => 'miked'],
            [
                'full_name' => 'Mike Davis',
                'email' => 'mike@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]
        );

        // Create demo teacher users
        $teacherUser1 = User::firstOrCreate(
            ['username' => 'teacher1'],
            [
                'full_name' => 'Teacher One',
                'email' => 'teacher@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]
        );

        $teacherUser2 = User::firstOrCreate(
            ['username' => 'teacher2'],
            [
                'full_name' => 'Teacher Two',
                'email' => 'teacher2@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]
        );

        $teacherUser3 = User::firstOrCreate(
            ['email' => 'teacher@brightminds.edu'],
            [
                'username' => 'teacher',
                'full_name' => 'Teacher One',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
            ]
        );

        // Create teacher records
        $teacher1 = Teacher::firstOrCreate(
            ['email' => 'teacher@brightminds.edu'],
            [
                'full_name' => 'Teacher One',
                'contact_number' => '123-456-7890',
            ]
        );

        $teacher2 = Teacher::firstOrCreate(
            ['email' => 'teacher2@brightminds.edu'],
            [
                'full_name' => 'Teacher Two',
                'contact_number' => '098-765-4321',
            ]
        );

        // Create classes
        $class1 = ClassModel::firstOrCreate(
            ['class_name' => 'Playgroup A'],
            [
                'age_range' => '3-4 years',
                'capacity' => 20,
                'school_year' => '2024-2025',
                'teacher_id' => $teacher1->teacher_id,
            ]
        );

        $class2 = ClassModel::firstOrCreate(
            ['class_name' => 'Nursery B'],
            [
                'age_range' => '4-5 years',
                'capacity' => 15,
                'school_year' => '2024-2025',
                'teacher_id' => $teacher1->teacher_id,
            ]
        );

        $class3 = ClassModel::firstOrCreate(
            ['class_name' => 'Kindergarten 1'],
            [
                'age_range' => '5-6 years',
                'capacity' => 18,
                'school_year' => '2024-2025',
                'teacher_id' => $teacher2->teacher_id,
            ]
        );

        $class4 = ClassModel::firstOrCreate(
            ['class_name' => 'Kindergarten 2'],
            [
                'age_range' => '6-7 years',
                'capacity' => 16,
                'school_year' => '2024-2025',
                'teacher_id' => $teacher2->teacher_id,
            ]
        );

        // Create guardians
        $guardian1 = Guardian::firstOrCreate(
            ['email' => 'alice@gmail.com'],
            [
                'full_name' => 'Alice Johnson',
                'phone_number' => '111-222-3333',
                'relationship' => 'Mother',
                'address' => '123 Main St, City',
            ]
        );

        $guardian2 = Guardian::firstOrCreate(
            ['email' => 'bob@gmail.com'],
            [
                'full_name' => 'Bob Smith',
                'phone_number' => '444-555-6666',
                'relationship' => 'Father',
                'address' => '456 Oak Ave, City',
            ]
        );

        $guardian3 = Guardian::firstOrCreate(
            ['email' => 'sarah@gmail.com'],
            [
                'full_name' => 'Sarah Wilson',
                'phone_number' => '777-888-9999',
                'relationship' => 'Mother',
                'address' => '789 Pine St, City',
            ]
        );

        $guardian4 = Guardian::firstOrCreate(
            ['email' => 'mike@gmail.com'],
            [
                'full_name' => 'Mike Davis',
                'phone_number' => '000-111-2222',
                'relationship' => 'Father',
                'address' => '321 Elm St, City',
            ]
        );

        // Create students
        $student1 = Student::firstOrCreate(
            ['full_name' => 'Emma Johnson', 'birth_date' => '2020-05-15'],
            [
                'gender' => 'Female',
                'address' => '123 Main St, City',
                'program' => 'nursery',
                'guardian_id' => $guardian1->guardian_id,
            ]
        );

        $student2 = Student::firstOrCreate(
            ['full_name' => 'Liam Smith', 'birth_date' => '2019-08-20'],
            [
                'gender' => 'Male',
                'address' => '456 Oak Ave, City',
                'program' => 'nursery',
                'guardian_id' => $guardian2->guardian_id,
            ]
        );

        $student3 = Student::firstOrCreate(
            ['full_name' => 'Sophia Wilson', 'birth_date' => '2018-12-10'],
            [
                'gender' => 'Female',
                'address' => '789 Pine St, City',
                'program' => 'kindergarten_1',
                'guardian_id' => $guardian3->guardian_id,
            ]
        );

        $student4 = Student::firstOrCreate(
            ['full_name' => 'Jackson Davis', 'birth_date' => '2017-03-25'],
            [
                'gender' => 'Male',
                'address' => '321 Elm St, City',
                'program' => 'kindergarten_2',
                'guardian_id' => $guardian4->guardian_id,
            ]
        );

        $student5 = Student::firstOrCreate(
            ['full_name' => 'Olivia Brown', 'birth_date' => '2021-01-08'],
            [
                'gender' => 'Female',
                'address' => '654 Maple Ave, City',
                'program' => 'nursery',
                'guardian_id' => $guardian1->guardian_id,
            ]
        );

        // Create enrollments (check if they don't already exist)
        Enrollment::firstOrCreate(
            ['student_id' => $student1->student_id, 'class_id' => $class1->class_id],
            [
                'enrollment_date' => '2024-09-01',
                'status' => 'enrolled',
            ]
        );

        Enrollment::firstOrCreate(
            ['student_id' => $student2->student_id, 'class_id' => $class2->class_id],
            [
                'enrollment_date' => '2024-09-01',
                'status' => 'enrolled',
            ]
        );

        Enrollment::firstOrCreate(
            ['student_id' => $student3->student_id, 'class_id' => $class3->class_id],
            [
                'enrollment_date' => '2024-09-01',
                'status' => 'enrolled',
            ]
        );

        Enrollment::firstOrCreate(
            ['student_id' => $student4->student_id, 'class_id' => $class4->class_id],
            [
                'enrollment_date' => '2024-09-01',
                'status' => 'enrolled',
            ]
        );

        Enrollment::firstOrCreate(
            ['student_id' => $student5->student_id, 'class_id' => $class1->class_id],
            [
                'enrollment_date' => '2024-09-01',
                'status' => 'pending',
            ]
        );

        // Create sample grades
        $grade1 = Grade::firstOrCreate(
            ['grade_number' => 1, 'section_id' => $class1->class_id],
            [
                'subject_id' => null,
                'fee_amount' => 1500.00,
            ]
        );

        $grade2 = Grade::firstOrCreate(
            ['grade_number' => 2, 'section_id' => $class2->class_id],
            [
                'subject_id' => null,
                'fee_amount' => 1600.00,
            ]
        );

        $grade3 = Grade::firstOrCreate(
            ['grade_number' => 3, 'section_id' => $class3->class_id],
            [
                'subject_id' => 101,
                'fee_amount' => 1800.00,
            ]
        );

        $grade4 = Grade::firstOrCreate(
            ['grade_number' => 4, 'section_id' => $class4->class_id],
            [
                'subject_id' => 102,
                'fee_amount' => 1900.00,
            ]
        );

        $grade5 = Grade::firstOrCreate(
            ['grade_number' => 5, 'section_id' => $class1->class_id],
            [
                'subject_id' => 103,
                'fee_amount' => 1700.00,
            ]
        );

        // Create sample payments
        Payment::firstOrCreate(
            ['student_id' => $student1->student_id, 'grade_id' => $grade1->grade_id],
            [
                'payment_date' => '2024-09-01',
                'payment_amount' => 1500.00,
            ]
        );

        Payment::firstOrCreate(
            ['student_id' => $student2->student_id, 'grade_id' => $grade2->grade_id],
            [
                'payment_date' => '2024-09-01',
                'payment_amount' => 1600.00,
            ]
        );

        Payment::firstOrCreate(
            ['student_id' => $student3->student_id, 'grade_id' => $grade3->grade_id],
            [
                'payment_date' => '2024-09-01',
                'payment_amount' => 1800.00,
            ]
        );

        Payment::firstOrCreate(
            ['student_id' => $student4->student_id, 'grade_id' => $grade4->grade_id],
            [
                'payment_date' => '2024-09-01',
                'payment_amount' => 1900.00,
            ]
        );

        // Additional payment for Emma (October fee)
        Payment::firstOrCreate(
            ['student_id' => $student1->student_id, 'grade_id' => $grade1->grade_id],
            [
                'payment_date' => '2024-10-01',
                'payment_amount' => 1500.00,
            ]
        );

        // Payment for Olivia (pending enrollment, but payment made)
        Payment::firstOrCreate(
            ['student_id' => $student5->student_id, 'grade_id' => $grade5->grade_id],
            [
                'payment_date' => '2024-09-01',
                'payment_amount' => 1700.00,
            ]
        );
    }
}
