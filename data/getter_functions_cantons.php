<script>
    function get_indexes() {
        //the same indexing which is used by the map
        var raw_indexes = <?php include('data/indexes_cantons.php'); ?>

        return JSON.parse(raw_indexes);
    }

    //function which returns name of feature (+1 because Switzerland is included)
    function get_name(feature) {
        let indexes = get_indexes();
        return indexes["Canton"][Number(feature.id) + 1];

    }


    // Cantons Average Farm Size =======================================================================================================
    function get_CAFS_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include('data/data_cantons_average_farm_size.php'); ?>;
        return JSON.parse(raw_data);
    }

    function get_average_farm_size(feature) {

        //getting the data
        var data = get_CAFS_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal average farm size (value) with the canton name
        value = Number(data["2021 average farm size"][canton]);
        value = Math.round(value * 10) / 10
        return value;
    }

    function get_number_of_farms(feature) {

        //getting the data
        var data = get_CAFS_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal number of farms (value) with the canton name
        value = Number(data["2021 number of farms"][canton]);
        value = Math.round(value * 100) / 100
        return value;
    }

    function get_total_farm_area(feature) {

        //getting the data
        var data = get_CAFS_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal total farm area (value) with the canton name
        value = Number(data["2021 total farm area"][canton]);
        value = Math.round(value * 100) / 100
        return value;
    }

    // soil artificialization ============================================================================================================================
    function get_soil_artificialization_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include('data/data_cantons_artificialization.php'); ?>;
        return JSON.parse(raw_data);
    }

    function get_soil_artificialization(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal soil artificialization (value) with the canton name
        value = Number(data["increase in artificial land"]["- " + canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    function get_artificial2018(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the (value) with the canton name
        value = Number(data["-10 Künstlich angelegte Flächen 2013/18"]["- " + canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    function get_artificial2009(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the (value) with the canton name
        value = Number(data["-10 Künstlich angelegte Flächen 2004/09"]["- " + canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    function get_area(feature) {

        //getting the data
        var data = get_soil_artificialization_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the (value) with the canton name
        value = Number(data["Fläche - Total 2013/18"]["- " + canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    // impermeability =============================================================================================================================

    function get_impermeability_data() {
        //the json files which were generated in create_data
        var raw_data = <?php include('data/data_cantons_impermeability.php'); ?>;
        return JSON.parse(raw_data);
    }

    function get_impermeability_percentage(feature) {
        //getting the data
        var data = get_impermeability_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal soil artificialization (CSA) with the canton name
        value = Number(data["percentage artificially impermeable"]["- " + canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    function get_impermeable(feature) {
        //getting the data
        var data = get_impermeability_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon)
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the value with the canton name
        value = Number(data[">>10.11 Befestigte Flächen 2013/18"]["- " + canton]) + Number(data[">>10.12 Gebäude 2013/18"]["- " + canton]) + Number(data[">>10.13 Treibhäuser 2013/18"]["- " + canton]) + Number(data[">>10.17 Gemischte Kleinstrukturen 2013/18"]["- " + canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    // organic farming ============================================================================================================================

    function get_organic_farming_percentage(feature) {
        //getting the data
        var data = get_organic_farming_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal percentage of biological farming (value) with the canton name
        value = Number(data["percentage biological farmland"][canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    function get_organic_farming_total_area(feature) {
        //getting the data
        var data = get_organic_farming_data();
        var indexes = get_indexes();

        //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
        id = Number(feature.id);
        id += 1;

        //getting the canton name with the id
        canton = indexes["Canton"][id];
        //getting the cantonal percentage of biological farming (value) with the canton name
        value = Number(data["Biologische Betriebe"][canton]);
        value = Math.round(value * 100) / 100;

        return value;
    }

    //farmers =================================================================================================================================
    function get_farmers_data() {
    //the json files which were generated in create_data
    var raw_data = <?php include("data/data_cantons_farmers.php"); ?>;
    return JSON.parse(raw_data);
  }

  function get_farmer_percentage(feature) {
    //getting the data
    var data = get_farmers_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the farmer percentage (value) with the canton name
    value = Number(data["farmers ratio"][canton]);
    value = Math.round(value * 100) / 100;
    return value;
  }

  function get_population(feature) {
    //getting the data
    var data = get_farmers_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the farmer percentage (value) with the canton name
    value = Number(data["population"][canton]);
    value = Math.round(value * 100) / 100;
    return value;
  }

  function get_farmers(feature) {
    //getting the data
    var data = get_farmers_data();
    var indexes = get_indexes();

    //this is the id of the feature (map polygon) we have to increase by one because the data includes "Switzerland"
    id = Number(feature.id);
    id += 1;

    //getting the canton name with the id
    canton = indexes["Canton"][id];
    //getting the farmer percentage (value) with the canton name
    value = Number(data["farmers"][canton]);
    value = Math.round(value * 100) / 100;
    return value;
  }
</script>