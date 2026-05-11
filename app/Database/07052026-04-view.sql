-- Active: 1741104595338@@127.0.0.1@3306@commejaime
create or replace view v_ingredientRegime as (
    select r.id as `regimeId`,i.lib as ingredient, r.nomplat as regime, ir.pourcentage as pourcentage, i.prixG as prixG, r.`poidsTotalPlat` as poidsTotalPlat
    from ingredients i
    join ingredientRegime ir on i.id = ir.ingredientId
    join regime r on r.id = ir.regimeId
);


