<template>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Task CSV Import</p>
    </header>
    <section class="modal-card-body">
      <b-steps type="is-dark" :has-navigation="false" destroy-on-hide v-model="currentStep">
        <b-step-item
          :clickable="false"
          :type="currentStep >= 1 ? 'is-success' : ''"
          label="Select columns"
        >
          <br />
          <b-notification type="is-info" :closable="false">
            <ul>
              <li>
                <b>Update:</b> To update matching tasks (matched by id) select the id column. No new tasks will be created, all the data you upload will update existing tasks. If a task is not found by id no update will occur for that task.
              </li>
              <li>
                <b>Create new:</b> To create only new tasks uncheck the id column. No tasks will be updated, all the data you upload will create new tasks.
              </li>
            </ul>
          </b-notification>
          <b-field label="Columns to import">
            <b-field grouped group-multiline>
              <b-field v-for="field in fields" :key="field">
                <b-checkbox v-model="activeFields" :native-value="field">{{ field }}</b-checkbox>
              </b-field>
            </b-field>
          </b-field>
        </b-step-item>
        <b-step-item
          :clickable="false"
          :type="currentStep >= 2 ? 'is-success' : ''"
          label="File column maps"
        >
          <b-notification type="is-info" :closable="false">
            <p>
              When you get
              <b>SEP=</b> for mapping the file is prepended by
              <b>SEP=,</b>
              <br />Remove it in a text editor
            </p>
          </b-notification>
          <csv-import
            buttonClass="control button"
            loadBtnText="Set Mapping.."
            ref="import"
            :headers="true"
            v-model="csv"
            :map-fields="activeFields"
          >
            <template slot="thead">
              <tr>
                <th>What we need for the database:</th>
                <th>What the file has you selected:</th>
              </tr>
            </template>
          </csv-import>
        </b-step-item>
        <b-step-item
          :clickable="false"
          :type="currentStep >= 3 ? 'is-success' : ''"
          label="Preview"
        >
          <b-table
            pagination-position="both"
            per-page="20"
            paginated
            narrowed
            :data="csv"
            :columns="tableColumns"
          ></b-table>
        </b-step-item>
        <b-step-item :clickable="false" :type="currentStep >= 4 ? 'is-success' : ''" label="Upload">
          <b-loading :is-full-page="true" :active="true" />
        </b-step-item>
        <b-step-item
          :clickable="false"
          :type="currentStep >= 4 ? 'is-success' : ''"
          label="Complete"
        ></b-step-item>
      </b-steps>
    </section>
    <section class="modal-card-foot">
      <b-button :disabled="currentStep == 4" @click="close()">Cancel</b-button>
      <b-button :disabled="!canGoPrevious" icon-left="arrow-left" @click="currentStep--">Previous</b-button>
      <b-button
        v-if="currentStep != 4"
        :disabled="!canGoNext"
        icon-right="arrow-right"
        @click="nextStep()"
      >{{ currentStep==2 ? 'Upload' : 'Next' }}</b-button>
      <b-button v-else type="is-success" @click="close()">Finish</b-button>
    </section>
  </div>
</template>

<script>
import api from "@/api.js";
export default {
  props: ["conference", "updated"],

  data() {
    return {
      isLoading: false,
      csv: [
        {
          id: "1",
          name: "1Sample task name",
          description: "1This is a fancy task description",
          location: "1 Awesome Road"
        },
        {
          id: "2",
          name: "2Sample task name",
          description: "2This is a fancy task description",
          location: "2 Awesome Road"
        },
        {
          id: "3",
          name: "3Sample task name",
          description: "3This is a fancy task description",
          location: "3 Awesome Road"
        },
        {
          id: "4",
          name: "Two task name",
          description: "Description is not optional",
          location: "Office"
        },
        {
          id: "6",
          name: "Lawn Service Manager",
          description: "Decentralized clear-thinking circuit",
          location: "169 Josiah Drives"
        },
        {
          id: "7",
          name: "Precision Dyer",
          description: "Innovative explicit projection",
          location: "72592 Doyle Plain"
        },
        {
          id: "10",
          name: "Electro-Mechanical Technician",
          description: "Multi-lateral optimizing access",
          location: "5437 Rebecca Fort"
        },
        {
          id: "13",
          name: "Middle School Teacher",
          description: "Configurable 5thgeneration focusgroup",
          location: "3579 Ellen Shoals"
        },
        {
          id: "18",
          name: "Structural Metal Fabricator",
          description: "Advanced analyzing application",
          location: "1091 Jarvis Dam"
        },
        {
          id: "19",
          name: "Sales Person",
          description: "Public-key stable core",
          location: "394 Cesar Meadow Suite 154"
        },
        {
          id: "22",
          name: "Timing Device Assemblers",
          description: "Enterprise-wide web-enabled function",
          location: "8028 Pouros Green"
        },
        {
          id: "28",
          name: "Spraying Machine Operator",
          description: "Multi-channelled national functionalities",
          location: "75611 Esmeralda Hollow"
        },
        {
          id: "33",
          name: "Elementary and Secondary School Administrators",
          description: "Multi-channelled responsive migration",
          location: "42656 Dooley Road"
        },
        {
          id: "51",
          name: "Host and Hostess",
          description: "Digitized bifurcated securedline",
          location: "5399 Ankunding Bridge Suite 414"
        },
        {
          id: "52",
          name: "Ticket Agent",
          description: "Organized mission-critical orchestration",
          location: "83741 Wisoky Field"
        },
        {
          id: "56",
          name: "Dental Laboratory Technician",
          description: "Operative mobile intranet",
          location: "57522 Gulgowski Center"
        },
        {
          id: "58",
          name: "Algorithm Developer",
          description: "Realigned even-keeled knowledgeuser",
          location: "812 Daniel Harbor Suite 936"
        },
        {
          id: "59",
          name: "Sheriff",
          description: "Right-sized radical GraphicalUserInterface",
          location: "1310 Darlene Summit Suite 169"
        },
        {
          id: "62",
          name: "Supervisor of Police",
          description: "Team-oriented actuating policy",
          location: "864 Odie Tunnel Apt. 135"
        },
        {
          id: "67",
          name: "Forest Fire Fighter",
          description: "Horizontal real-time analyzer",
          location: "212 Electa Mountains"
        },
        {
          id: "75",
          name: "Credit Analyst",
          description: "Realigned cohesive GraphicalUserInterface",
          location: "84621 Lindgren Tunnel"
        },
        {
          id: "80",
          name: "Gaming Surveillance Officer",
          description: "Future-proofed disintermediate conglomeration",
          location: "4995 Dena Course Apt. 984"
        },
        {
          id: "84",
          name: "Computer Scientist",
          description: "Multi-channelled well-modulated protocol",
          location: "7978 Okuneva Parks"
        },
        {
          id: "86",
          name: "Construction Equipment Operator",
          description: "Reactive zeroadministration GraphicalUserInterface",
          location: "3424 Beier Harbor"
        },
        {
          id: "89",
          name: "Industrial Safety Engineer",
          description: "Managed client-server intranet",
          location: "84568 Hane Walk"
        },
        {
          id: "95",
          name: "Compacting Machine Operator",
          description: "Future-proofed needs-based hub",
          location: "321 Lionel Dale Suite 558"
        },
        {
          id: "100",
          name: "Occupational Therapist Assistant",
          description: "Centralized contextually-based internetsolution",
          location: "63368 Hyatt Motorway Apt. 078"
        },
        {
          id: "103",
          name: "Animal Husbandry Worker",
          description: "Configurable methodical focusgroup",
          location: "415 Kuhlman Knoll Suite 617"
        },
        {
          id: "107",
          name: "Information Systems Manager",
          description: "Distributed cohesive functionalities",
          location: "20122 Torrey Station"
        },
        {
          id: "112",
          name: "Physics Teacher",
          description: "Enhanced zeroadministration GraphicInterface",
          location: "1865 Tyree Field"
        },
        {
          id: "113",
          name: "Environmental Engineering Technician",
          description: "Facetoface homogeneous info-mediaries",
          location: "93012 Little Pine Apt. 020"
        },
        {
          id: "116",
          name: "Compensation and Benefits Manager",
          description: "Right-sized needs-based middleware",
          location: "9104 Zelda Summit Suite 131"
        },
        {
          id: "121",
          name: "HR Manager",
          description: "Open-architected dynamic standardization",
          location: "28897 Malinda Springs"
        },
        {
          id: "122",
          name: "Night Security Guard",
          description: "Sharable modular openarchitecture",
          location: "9683 Sydnie Glen"
        },
        {
          id: "134",
          name: "Marine Cargo Inspector",
          description: "Enterprise-wide 24/7 synergy",
          location: "2153 Carmen Cape"
        },
        {
          id: "136",
          name: "Stonemason",
          description: "Re-engineered disintermediate implementation",
          location: "80040 Wyatt Lights"
        },
        {
          id: "137",
          name: "Sawing Machine Tool Setter",
          description: "Stand-alone stable superstructure",
          location: "652 Shields Pike"
        },
        {
          id: "145",
          name: "Pastry Chef",
          description: "Innovative reciprocal architecture",
          location: "98538 Isidro Islands"
        },
        {
          id: "147",
          name: "Upholsterer",
          description: "Re-contextualized holistic time-frame",
          location: "4378 Brad Lights Suite 491"
        },
        {
          id: "155",
          name: "Mechanical Engineer",
          description: "Automated static time-frame",
          location: "20943 Beier Trafficway Apt. 108"
        },
        {
          id: "156",
          name: "Rolling Machine Setter",
          description: "Visionary high-level concept",
          location: "45595 Rempel Manor Suite 172"
        },
        {
          id: "157",
          name: "Gas Pumping Station Operator",
          description: "Enhanced empowering budgetarymanagement",
          location: "1348 Huels Lodge Suite 678"
        },
        {
          id: "159",
          name: "Logistician",
          description: "Future-proofed incremental processimprovement",
          location: "573 Shakira Landing Apt. 793"
        },
        {
          id: "163",
          name: "Pest Control Worker",
          description: "User-centric grid-enabled service-desk",
          location: "6374 Gabriella Shores"
        },
        {
          id: "169",
          name: "Stone Sawyer",
          description: "Expanded methodical success",
          location: "609 Feeney Inlet Suite 078"
        },
        {
          id: "182",
          name: "Preschool Education Administrators",
          description: "Optimized attitude-oriented matrix",
          location: "964 Claire Circles Suite 823"
        },
        {
          id: "189",
          name: "Licensed Practical Nurse",
          description: "Down-sized foreground frame",
          location: "549 Junius Garden Apt. 113"
        },
        {
          id: "193",
          name: "Survey Researcher",
          description: "Virtual mobile hub",
          location: "40026 Nader Run"
        },
        {
          id: "205",
          name: "Caption Writer",
          description: "Realigned discrete complexity",
          location: "317 Keira Haven"
        }
      ],
      fields: [
        "id",
        "name",
        "description",
        "location",
        "date",
        "start_at",
        "end_at",
        "priority",
        "slots",
        "hours"
      ],
      activeFields: ["id", "name", "description", "location"],
      currentStep: 2
    };
  },

  methods: {
    close() {
      this.updated();
      this.$parent.close();
    },
    nextStep() {
      this.currentStep++;
      if (this.currentStep == 3) {
        // Upload
        api
          .importTasks(this.csv, this.conference.key)
          .then(data => {})
          .catch(error => {})
          .finally(() => {
            this.currentStep++;
          });
      }
    }
  },

  computed: {
    tableColumns() {
      var columns = this.activeFields.map(field => {
        return {
          field: field,
          label: field,
          searchable: true,
          sortable: true
        };
      });

      return columns;
    },
    canGoNext() {
      if (this.currentStep >= 4 || (!this.csv && this.currentStep == 1)) {
        return false;
      } else {
        return true;
      }
    },
    canGoPrevious() {
      if (this.currentStep <= 0 || this.currentStep == 4) {
        return false;
      } else {
        return true;
      }
    }
  },

  created() {
    this.activeFields = this.fields;
  }
};
</script>
