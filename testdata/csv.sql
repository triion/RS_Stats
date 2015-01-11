SQL for CSV

SELECT '' as firstName, p.name, p.country, ps.position, ps.flank, 'YES' as MainSquad, ps.stars, ps.fitness, '' as Injured, ps.age, 'NO' as U21, '' as wages,'' as yearly,'' as market, p.talent, ps.endurance, ps.power, ps.speed, ps.blocking, ps.dueling, ps.passing, ps.scoring, ps.tactics, ps.goalkeeping, ps.defending, ps.midfield, ps.attacking, ps.specials FROM players as p 
LEFT JOIN playerstats as ps ON p.id=ps.player_id
WHERE p.team_id=897 AND ps.date=MAX(ps.date)
GROUP BY p.name



SELECT 
    '' as firstName, 
    p.name, 
    p.country, 
    ps.position, 
    ps.flank, 
    'YES' as MainSquad, 
    ps.stars, 
    ps.fitness, 
    '' as Injured, 
    ps.age, 
    'NO' as U21, 
    '' as wages,
    '' as yearly,
    '' as market, 
    p.talent, 
    ps.endurance, 
    ps.power, 
    ps.speed, 
    ps.blocking, 
    ps.dueling, 
    ps.passing, 
    ps.scoring, 
    ps.tactics, 
    ps.goalkeeping, 
    ps.defending, 
    ps.midfield, 
    ps.attacking, 
    ps.specials 
FROM players as p 
LEFT JOIN playerstats as ps /*GET latest Stats from db via subquery*/
    ON ps.id=(SELECT id FROM playerstats WHERE player_id = p.id ORDER BY date DESC LIMIT 1) 
WHERE p.team_id=897 
GROUP BY p.name