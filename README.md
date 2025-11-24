# KDB Module

## Description

This module creates a custom content entity type called "Ejercicio KDB" without bundles, with specific fields, custom validations, and advanced Views integration for data visualization and filtering.

## Features

### Entity fields:
- **Dato 1** (`dato_1`): Integer field, required
- **Dato 2** (`dato_2`): Integer field, required
- **Etiqueta** (`etiqueta`): Reference to terms from the "tags" taxonomy

### Validations:
1. **Different values**: Dato 1 and Dato 2 cannot have the same value
2. **Uniqueness**: There cannot be more than one entity with the same combination of Dato 1 and Dato 2

### Views Integration:
The module provides extensive Views integration with custom fields, filters, and sort criteria for advanced data display and analysis.

## Installation

1. Make sure the Taxonomy module is enabled
2. Make sure the Views module is enabled
3. Make sure the "tags" vocabulary exists in your Drupal installation
4. Enable the `ejercicio_kdb` module
5. Clear Drupal cache: `drush cr`

## Usage

### Permissions

The module defines the following permissions:
- Administer Ejercicio KDB entities
- View Ejercicio KDB entities
- Create Ejercicio KDB entities
- Edit Ejercicio KDB entities
- Delete Ejercicio KDB entities

Configure permissions at: `/admin/people/permissions`

### Administration

Access the entity list at: `/admin/content/ejercicio-kdb`

From there you can:
- View all created entities
- Add new entities
- Edit existing entities
- Delete entities

### Structure Management

Access entity configuration at: `/admin/structure/ejercicio-kdb/settings`

From there you can:
- Configure entity settings
- Manage form display
- Manage view display
- Configure field settings

## Views Integration

### Creating Views

1. Go to `/admin/structure/views/add`
2. Select "Ejercicio KDB" as the view type
3. Configure your view with the available fields, filters, and sort criteria

### Available Fields

The module provides the following fields for Views:

- **Dato 1**: First integer value
- **Dato 2**: Second integer value
- **Etiqueta**: Taxonomy term reference
- **Resultado**: Calculated field showing `(Dato 1 × 5) + (Dato 2 × 10)`

### Custom Filter: Field Operations Filter

Filter entities based on mathematical operations between Dato 1 and Dato 2.

**Available in**: Add Filter → "Field Operations Filter"

**Operation**: Resultado `(Dato 1 × 5) + (Dato 2 × 10)`

**Comparison operators**:
- Equal to (=)
- Not equal to (!=)
- Greater than (>)
- Greater than or equal to (>=)
- Less than (<)
- Less than or equal to (<=)

**Example usage**:
- Filter entities where Resultado > 100
- Show only records where Resultado = 500
- Display items where Resultado <= 1000

### Custom Sort Criteria

**Resultado Sort**: Order results by the calculated "Resultado" field

**Available in**: Add Sort Criteria → "Resultado"

**Options**:
- Ascending (smallest to largest)
- Descending (largest to smallest)

**Example**:
Sort entities by their Resultado value in descending order to show the highest calculated values first.

### Example View Configuration

**Display the top 10 entities with highest Resultado values:**

1. Create a new view with "Ejercicio KDB"
2. Add fields: Dato 1, Dato 2, Etiqueta, Resultado
3. Add sort criteria: "Resultado" (Descending)
4. Set items per page: 10

**Filter entities with specific Resultado range:**

1. Create a new view with "Ejercicio KDB"
2. Add filter: "Field Operations Filter"
   - Operation: Resultado
   - Operator: Greater than
   - Value: 100
3. Add another filter: "Field Operations Filter"
   - Operation: Resultado
   - Operator: Less than
   - Value: 500
4. Add sort: "Resultado" (Ascending)

## File structure

```
ejercicio_kdb/
├── config/
│   └── install/
│       ├── core.entity_view_display.ejercicio_kdb.ejercicio_kdb.default.yml
│       └── core.entity_form_display.ejercicio_kdb.ejercicio_kdb.default.yml
├── src/
│   ├── Entity/
│   │   ├── EjercicioKdb.php
│   │   └── EjercicioKdbViewsData.php
│   ├── Form/
│   │   ├── EjercicioKdbForm.php
│   │   └── EjercicioKdbSettingsForm.php
│   ├── Controller/
│   │   └── EjercicioKdbController.php
│   ├── Plugin/
│   │   ├── Validation/
│   │   │   └── Constraint/
│   │   │       ├── EjercicioKdbValidationConstraint.php
│   │   │       └── EjercicioKdbValidationConstraintValidator.php
│   │   └── views/
│   │       ├── field/
│   │       │   └── EjercicioKdbCalculatedField.php
│   │       ├── filter/
│   │       │   └── EjercicioKdbOperationFilter.php
│   │       └── sort/
│   │           └── EjercicioKdbResultadoSort.php
│   └── EjercicioKdbListBuilder.php
├── ejercicio_kdb.info.yml
├── ejercicio_kdb.install
├── ejercicio_kdb.routing.yml
├── ejercicio_kdb.permissions.yml
├── ejercicio_kdb.links.menu.yml
├── ejercicio_kdb.links.action.yml
├── ejercicio_kdb.links.task.yml
└── README.md
```

## Technical notes

- The entity has no bundles, it is a simple content entity
- Validations are implemented in the form to ensure data integrity
- The taxonomy reference is specifically configured for the "tags" vocabulary
- Views integration uses custom plugins for calculated fields, filters, and sorting
- All calculations are performed at the database level (SQL) for optimal performance
- The "Resultado" calculation formula is: `(dato_1 × 5) + (dato_2 × 10)`

## API

### Views Data

The module provides custom Views data through `EjercicioKdbViewsData` class, which extends `EntityViewsData`.

### Custom Views Plugins

**Field Plugin**: `ejercicio_kdb_calculated_field`
- Displays calculated values based on Dato 1 and Dato 2
- Supports "resultado" calculation type

**Filter Plugin**: `ejercicio_kdb_operation_filter`
- Filters based on the Resultado calculation
- Supports multiple comparison operators

**Sort Plugin**: `ejercicio_kdb_resultado_sort`
- Sorts results by the calculated Resultado value
- Supports ascending and descending order

## Troubleshooting

### Views not showing custom fields

1. Clear all caches: `drush cr`
2. Rebuild Views data: `drush views-rebuild` or visit `/admin/structure/views/settings/advanced`
3. Check that the module dependencies (Views, Taxonomy) are enabled

### Validation errors

Ensure that:
- Dato 1 and Dato 2 have different values
- No other entity exists with the same Dato 1 and Dato 2 combination

## Support

For issues or questions about this module, contact me.

