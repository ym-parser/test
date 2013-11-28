<?php

class m121016_131443_ngin extends CDbMigration {
  public function safeUp() {
    
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 104)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 104");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=104 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=104");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 105)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 105");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=105 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=105");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 63 AND id_instance = 49)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 63 AND id_instance = 49");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=49 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=63)");
    $this->execute("DELETE FROM da_object_view WHERE id_object_view=49");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 630)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 630");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=630 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=630");
    $this->execute("UPDATE da_object SET sequence = '1', name = 'Объекты', object_type = '1', table_name = 'da_object', folder_name = NULL, field_caption = 'name', id_field_caption = '64', id_field_order = '104', order_type = '1', seq_start_value = '500', yii_model = 'ngin.models.object.DaObject', id_object_handler = '406', id_instance_class = '444', parent_object = '1', use_domain_isolation = '0' WHERE id_object=20");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 20");
    $this->execute("INSERT INTO da_domain_object(id_domain, id_object) 
                               VALUES(1, 20)");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 628)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 628");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=628 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=628");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 79");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 624)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 624");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=624 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=624");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 625)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 625");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=625 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=625");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 626)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 626");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=626 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=626");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 627)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 627");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=627 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=627");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 623)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 623");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=623 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=623");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 79");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 20 AND id_instance = 79)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 20 AND id_instance = 79");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=79 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=20)");
    $this->execute("DELETE FROM da_object WHERE id_object=79");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 103)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 103");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=103 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=103");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 102)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 102");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=102 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=102");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 101)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 101");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=101 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=101");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 63 AND id_instance = 48)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 63 AND id_instance = 48");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=48 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=63)");
    $this->execute("DELETE FROM da_object_view WHERE id_object_view=48");
    $this->execute("UPDATE da_object SET sequence = '6', name = 'Агрегаторы', object_type = '1', table_name = 'da_aggregator', folder_name = NULL, field_caption = 'name', id_field_caption = NULL, id_field_order = NULL, order_type = '1', seq_start_value = '1', yii_model = NULL, id_object_handler = NULL, id_instance_class = NULL, parent_object = '5', use_domain_isolation = '0' WHERE id_object=78");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 78");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 622)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 622");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=622 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=622");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 621)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 621");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=621 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=621");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 620)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 620");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=620 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=620");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 619)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 619");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=619 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=619");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 617)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 617");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=617 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=617");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 618)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 618");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=618 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=618");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 616)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 616");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=616 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=616");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 629)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 629");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=629 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=629");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 78");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 20 AND id_instance = 78)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 20 AND id_instance = 78");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=78 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=20)");
    $this->execute("DELETE FROM da_object WHERE id_object=78");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 100)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 100");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=100 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=100");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 63 AND id_instance = 47)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 63 AND id_instance = 47");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=47 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=63)");
    $this->execute("DELETE FROM da_object_view WHERE id_object_view=47");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 633)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 633");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=633 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=633");
    $this->execute("UPDATE da_object SET sequence = '6', name = 'Типы агрегаторов', object_type = '1', table_name = 'da_aggregator_type', folder_name = NULL, field_caption = 'name', id_field_caption = NULL, id_field_order = NULL, order_type = '1', seq_start_value = '10', yii_model = NULL, id_object_handler = NULL, id_instance_class = NULL, parent_object = '5', use_domain_isolation = '0' WHERE id_object=77");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 77");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 632)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 632");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=632 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=632");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 631)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 631");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=631 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=631");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 77");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 20 AND id_instance = 77)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 20 AND id_instance = 77");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=77 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=20)");
    $this->execute("DELETE FROM da_object WHERE id_object=77");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 81)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 81");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=81 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=81");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 82)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 82");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=82 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=82");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 83)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 83");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=83 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=83");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 84)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 84");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=84 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=84");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 63 AND id_instance = 39)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 63 AND id_instance = 39");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=39 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=63)");
    $this->execute("DELETE FROM da_object_view WHERE id_object_view=39");
    $this->execute("UPDATE da_object SET sequence = '2', name = 'Курс валют', object_type = '1', table_name = 'da_currency_rate', folder_name = NULL, field_caption = 'value_rate', id_field_caption = NULL, id_field_order = NULL, order_type = '1', seq_start_value = '1', yii_model = NULL, id_object_handler = NULL, id_instance_class = NULL, parent_object = '5', use_domain_isolation = '0' WHERE id_object=59");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 59");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 328)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 328");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=328 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=328");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 329)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 329");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=329 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=329");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 327)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 327");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=327 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=327");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 326)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 326");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=326 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=326");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 59");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 20 AND id_instance = 59)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 20 AND id_instance = 59");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=59 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=20)");
    $this->execute("DELETE FROM da_object WHERE id_object=59");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 109)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 109");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=109 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=109");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 110)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 110");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=110 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=110");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 66 AND id_instance = 111)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 66 AND id_instance = 111");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=111 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=66)");
    $this->execute("DELETE FROM da_object_view_column WHERE id_object_view_column=111");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 63 AND id_instance = 51)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 63 AND id_instance = 51");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=51 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=63)");
    $this->execute("DELETE FROM da_object_view WHERE id_object_view=51");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 352)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 352");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=352 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=352");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 349)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 349");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=349 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=349");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 346)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 346");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=346 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=346");
    $this->execute("UPDATE da_object SET sequence = '5', name = 'Параметры php-скрипта', object_type = '1', table_name = 'da_php_script_type_parameter', folder_name = NULL, field_caption = 'parameter_name', id_field_caption = NULL, id_field_order = NULL, order_type = '1', seq_start_value = '1000', yii_model = NULL, id_object_handler = NULL, id_instance_class = NULL, parent_object = '80', use_domain_isolation = '0' WHERE id_object=81");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 81");
    $this->execute("INSERT INTO da_domain_object(id_domain, id_object) 
                               VALUES(1, 81)");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 345)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 345");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=345 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=345");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 344)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 344");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=344 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=344");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 21 AND id_instance = 343)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 21 AND id_instance = 343");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=343 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=21)");
    $this->execute("DELETE FROM da_object_parameters WHERE id_parameter=343");
    $this->execute("UPDATE da_object SET sequence = '5', name = 'Параметры php-скрипта', object_type = '1', table_name = 'da_php_script_type_parameter', folder_name = NULL, field_caption = 'parameter_name', id_field_caption = NULL, id_field_order = NULL, order_type = '1', seq_start_value = '1000', yii_model = NULL, id_object_handler = NULL, id_instance_class = NULL, parent_object = '80', use_domain_isolation = '0' WHERE id_object=81");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 81");
    $this->execute("INSERT INTO da_domain_object(id_domain, id_object) 
                               VALUES(1, 81)");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 26 AND id_instance = 121)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 26 AND id_instance = 121");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=121 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=26)");
    $this->execute("DELETE FROM da_permissions WHERE id_permission=121");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 26 AND id_instance = 120)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 26 AND id_instance = 120");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=120 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=26)");
    $this->execute("DELETE FROM da_permissions WHERE id_permission=120");
    $this->execute("DELETE FROM `da_auth_item_child` WHERE `child` like '%object_81'");
    $this->execute("DELETE FROM `da_auth_item` WHERE `da_auth_item`.`name` = 'list_object_81' LIMIT 1");
    $this->execute("DELETE FROM `da_permissions` WHERE `id_permission_type` =4");
    $this->execute("DELETE FROM da_domain_object WHERE id_object = 81");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 20 AND id_instance = 81)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 20 AND id_instance = 81");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=81 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=20)");
    $this->execute("DELETE FROM da_object WHERE id_object=81");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 80 AND id_instance = 1)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 80 AND id_instance = 1");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=1 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=80)");
    $this->execute("DELETE FROM da_php_script_type WHERE id_php_script_type=1");
    $this->execute("DELETE FROM da_localization_element_value WHERE id_localization_element IN (SELECT id_localization_element FROM da_localization_element WHERE id_object = 86 AND id_instance = 3)");
    $this->execute("DELETE FROM da_localization_element WHERE id_object = 86 AND id_instance = 3");
    $this->execute("DELETE FROM da_object_property_value WHERE id_object_instance=3 AND ID_PROPERTY IN (SELECT ID_PROPERTY FROM da_object_property WHERE id_object=86)");
    $this->execute("DELETE FROM da_php_script_interface WHERE id_php_script_interface=3");

    $path = dirname(__FILE__)."/../../assets/";
    HFile::removeDirectoryRecursive($path, false);
  }

  public function safeDown() {
    echo get_class($this)." does not support migration down.\n";
    return false;
  }
}
