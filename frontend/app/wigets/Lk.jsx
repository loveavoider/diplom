import {Tab, TabList, TabPanel, TabPanels, Tabs, Box, Button} from "@chakra-ui/react";
import {sendGet} from "@/app/util/axios";
import {useEffect, useState} from "react";
import TaskList from "@/app/components/TaskList";
import { Link } from "@chakra-ui/next-js";
import {useRedirect} from "@/app/util/redirect";

function logOut() {
    localStorage.removeItem('refresh');
    localStorage.removeItem('jwt');

    useRedirect('/');
}

export function Lk() {
    const [tasks, setTasks] = useState([]);
    const [isBank, setIsBank] = useState(false);

    useEffect(() => {
        (async () => {
            const { data } = await sendGet('tasks', true);
            setTasks(data);

            const res = await sendGet('user/me', true);
            setIsBank(res.data.role === 2);
        })()


    }, []);

    return (
        <>
            { !isBank ?<Link href={"/create"}><Button colorScheme='blue'>Создать заявку</Button></Link> : ''}
            <Button colorScheme='red' onClick={() => logOut()} ml="15px">Выйти</Button>
            <Box display="flex" justifyContent="center">
                <Box w="55%">
                    <Tabs>
                        <TabList>
                            <Tab>Черновики</Tab>
                            <Tab>Успешный скоринг</Tab>
                            <Tab>Действующие гарантии</Tab>
                            <Tab>Отклонённые гарантии</Tab>
                        </TabList>

                        <TabPanels>
                            <TabPanel>
                                <TaskList tasks={tasks} tab={1} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} tab={2} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} tab={3} />
                            </TabPanel>
                            <TabPanel>
                                <TaskList tasks={tasks} tab={4} />
                            </TabPanel>
                        </TabPanels>
                    </Tabs>
                </Box>
            </Box>
        </>
    );
}