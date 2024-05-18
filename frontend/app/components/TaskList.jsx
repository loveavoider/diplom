'use client';

import {Box, List, ListIcon, ListItem, Stack} from "@chakra-ui/react";
import { EditIcon } from '@chakra-ui/icons';
import Task from "@/app/components/Task";
import Link from "next/link";

export default function TaskList({tasks, filter = 1}) {

    tasks = tasks.filter(task => task.tab === filter);

    return (
        <List spacing={3}>
            {tasks.length ? tasks.map(task => {
                return (
                    <Box key={task.id} mb="16px">
                        <Link href={`/task/${task.id}`}>
                            <ListItem border="1px" p="5px" borderRadius="10px" borderColor="gray.300" display="flex">
                                <ListIcon mt="4px" as={EditIcon}/><Task title={task.title} />
                            </ListItem>
                        </Link>
                    </Box>
                )
            }) : <Box>Нет задач с таким статусом</Box>}
        </List>
    )
}