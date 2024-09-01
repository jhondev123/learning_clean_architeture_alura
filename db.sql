CREATE TABLE students (
    cpf TEXT PRIMARY KEY,
    name TEXT,
    email TEXT
);

CREATE TABLE phones (
    number TEXT,
    cpf_student TEXT,
    PRIMARY KEY (number),
    FOREIGN KEY (cpf_student) REFERENCES students(cpf)
);