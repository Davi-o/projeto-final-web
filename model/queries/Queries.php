<?php


namespace Enum;

use SplEnum;

class Queries
{
    const SELECT_ALL = "
        select person.id as personId,
               person.name as personName,
               person.surname as personSurname,
               person.birthdate as birthdate,
               person.type as type,
               person.document as document,
               person.gender as gender,
               pa.id as addressId,
               pa.address as address,
               pa.complement as complement,
               pa.number as addressNumber,
               pa.postal_code as postalCode,
               pc.id as phoneNumberId,
               pc.phone_number as phoneNumber
        from person
        inner join person_address pa on person.id = pa.person_id
        inner join person_contact pc on person.id = pc.person_id
    ";

    const SELECT_ONE = self::SELECT_ALL."
        where person.id = :id
    ";

    const DELETE_PERSON = "delete from person where id = :id";
    const DELETE_ADDRESS = "delete from person_address where person_id = :id";
    const DELETE_CONTACT = "delete from person_contact where person_id = :id";

    const INSERT_INTO_PERSON = "insert into person values(null, :name, :surname, :gender, :type, :document, :birthdate)";
    const INSERT_INTO_ADDRESS = "insert into person_address values(null, :person_id, :postal_code, :address, :number, :complement)";
    const INSERT_INTO_CONTACT = "insert into person_contact values(null, :person_id, :phone_number)";

    const UPDATE_PERSON = "
        update person 
        set name = :name,
            surname = :surname,
            gender = :gender,
            type = :type,
            document = :document,
            birthdate = :birthdate
        where id = :id
    ";

    const UPDATE_ADDRESS = "
        update person_address
        set postal_code = :postal_code,
            address = :address,
            number = :number,
            complement = :complement
        where id = :id
    ";

    const UPDATE_CONTACT = "
        update person_contact
        set phone_number = :phone_number
        where id = :id
    ";

}
