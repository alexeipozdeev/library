<?php

namespace Service\FieldType;


class FieldType
{
    /** ��� ���� ������ boolean */
    const BOOL = 0;
    /** ��� ���� ������ integer */
    const INT = 1;
    /** ��� ���� ������ string */
    const VARCHAR = 2;
    /** ��� ���� ������ ��� ��������������� ������ */
    const TEXT = 3;
    /** ��� ���� ������ ��� ���� */
    const DATETIME = 4;
    /** ��� ���� ������ float */
    const FLOAT = 5;

    //�������� �����, ������� ����������� � fields � ������
    const FIELDS = [
        self::BOOL => 'bool',
        self::INT => 'int',
        self::VARCHAR => 'varchar',
        self::TEXT => 'text',
        self::DATETIME => 'datetime',
        self::FLOAT => 'float',
    ];
}